# Readme
## Sample service definition
```yaml
services:
    app:
        image: ghcr.io/serhioli/dummy-app:latest
        ports:
          - "8888:8080"
        environments:
            APP_SLOWING_ENABLED: "true" # "true" | "false"
            APP_SLOWING_MIN_MICROSECONDS: 1000 # <int>
            APP_SLOWING_MAX_MICROSECONDS: 5000 # <int>
```
# Routes definition
### `GET /site`
Healthcheck
##### Response
```json
{
    "content": "OK"
}
```

### `GET /api/data`
Return random fields + applies slowing config
##### Response
```json
{
    "data": {
        "random": "1234.1234.1234.1234",
        "time": "<current date>"
    },
    "config": {
        "slowing": {
            "enabled": true,
            "min": 100,
            "max": 200
        }
    }
}
```
