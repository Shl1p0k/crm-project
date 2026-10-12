FROM alpine:latest
RUN apk add --no-cache sqlite
RUN mkdir -p /dbdata
CMD ["sh", "-c", "echo 'SQLite container ready' && sleep 5"]