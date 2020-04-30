FROM webdevops/php-nginx:7.4

ENV WEB_DOCUMENT_ROOT=/app/public

COPY --chown=1000:1000 . /app