## Linux installation

```bash
$ wget -qO- https://get.docker.com/ | sh
$ sudo curl --create-dirs -o /usr/local/bin/docker-compose -L https://github.com/docker/compose/releases/download/1.9.0/docker-compose-`uname -s`-`uname -m`
$ sudo chmod +x /usr/local/bin/docker-compose
$ sudo usermod -aG docker $USER
```

## Windows installation

- Download [Docker](https://download.docker.com/win/stable/InstallDocker.msi) or [Docker Toolbox](https://github.com/docker/toolbox/releases/tag/v1.12.5):
- Add environment variable `COMPOSE_CONVERT_WINDOWS_PATHS` with value `0`

> Your project must be located at `C:/Users/<User>/...` directory. It important!
