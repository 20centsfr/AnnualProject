#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <mysql/mysql.h>
#include <curl/curl.h>
#include "bannedWords.h"

#define MAX_INPUT_LENGTH 256
#define MAX_RESPONSE_LENGTH 2048

typedef struct MYSQL MYSQL;
typedef struct CURL CURL;

static size_t write_callback(char *ptr, size_t size, size_t nmemb, void *userdata) {
    strcat(userdata, ptr);
    return size * nmemb;
}

char* get_chatbot_response(MYSQL *con, CURL *curl_handle, char *input) {
    char response[MAX_RESPONSE_LENGTH];


    for (int i = 0; i < sizeof(banned_words) / sizeof(banned_words[0]); i++) {
        if (strstr(input, banned_words[i])) {
            return strdup("mot banni fdp ressaye.");
        }
    }

    char query[256];
    sprintf(query, "SELECT response FROM chatbot WHERE input='%s'", input);

    if (mysql_query(con, query)) {
        fprintf(stderr, "%s\n", mysql_error(con));
        return NULL;
    }

    MYSQL_RES *result = mysql_store_result(con);
    MYSQL_ROW row = mysql_fetch_row(result);

    if (row) {
        return strdup(row[0]);
    } else {
        char url[256];
        sprintf(url, "https://api.openai.com/v1/engines/davinci-codex/completions?prompt=%s", input);
        curl_easy_setopt(curl_handle, CURLOPT_URL, url);
        struct curl_slist *headers = NULL;
        headers = curl_slist_append(headers, "Content-Type: application/json");
        char authorization[1024];
        sprintf(authorization, "Authorization: Bearer %s", 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);
        headers = curl_slist_append(headers, authorization);
        curl_easy_setopt(curl_handle, CURLOPT_HTTPHEADER, headers);
        curl_easy_setopt(curl_handle, CURLOPT_WRITEDATA, response);
        CURLcode res = curl_easy_perform(curl_handle);
        curl_slist_free_all(headers);

        if (res != CURLE_OK) {
            fprintf(stderr, "curl_easy_perform() failed: %s\n", curl_easy_strerror(res));
            return NULL;
        }

        char insert_query[512];
        sprintf(insert_query, "INSERT INTO chatbot (input, response) VALUES ('%s', '%s')", input, response);
        if (mysql_query(con, insert_query)) {
            fprintf(stderr, "%s\n", mysql_error(con));
        }

        return strdup(response);
    }
}

int main() {
    char input[MAX_INPUT_LENGTH];
    MYSQL *con = mysql_init(NULL);

    if (con == NULL) {
        fprintf(stderr, "%s\n", mysql_error(con));
        exit(1);
    }

    if (mysql_real_connect(con, "localhost", "root", "root", "ts", 0, NULL, 0) == NULL) {
        fprintf(stderr, "%s\n", mysql_error(con));
        mysql_close(con);
        exit(1);
    }

    CURL *curl_handle;
    curl_global_init(CURL_GLOBAL_ALL);
    curl_handle = curl_easy_init();
    curl_easy_setopt(curl_handle, CURLOPT_WRITEFUNCTION, write_callback);

    while (1) {
        printf("User: ");
        fgets(input, MAX_INPUT_LENGTH, stdin);
        input[strcspn(input, "\n")] = 0;

        char* response = get_chatbot_response(con, curl_handle, input);
        if (response) {
            printf("chatbot: %s\n", response);
            free(response);
        } else {
            printf("chatbot : pa compris\n");
        }
    }

    mysql_close(con);
    curl_easy_cleanup(curl_handle);
    curl_global_cleanup();

    return 0;
}