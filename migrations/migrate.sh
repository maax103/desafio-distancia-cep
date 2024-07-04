#!/bin/sh

sleep 4

for file in /migrations/*.sql; do
    filename=$(basename "$file")
    if ! mysql -h db -u myuser -pmypassword mydatabase -e "SELECT migration_name FROM migration_log WHERE migration_name = '$filename'" | grep "$filename"; then
        echo "Running migration: $filename"
        mysql -h db -u myuser -pmypassword mydatabase < "$file"
        mysql -h db -u myuser -pmypassword mydatabase -e "INSERT INTO migration_log (migration_name) VALUES ('$filename')"
    fi
done
