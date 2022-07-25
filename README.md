# Readme
[![Open in Gitpod](https://gitpod.io/button/open-in-gitpod.svg)](https://gitpod.io/#serhioli/dummy-app)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fserhioli%2Fdummy-app.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fserhioli%2Fdummy-app?ref=badge_shield)
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


## License
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fserhioli%2Fdummy-app.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fserhioli%2Fdummy-app?ref=badge_large)