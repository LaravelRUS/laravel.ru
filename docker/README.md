#### Docker of Linux

```bash
$ wget -qO- https://get.docker.com/ | sh
$ sudo curl --create-dirs -o /usr/local/bin/docker-compose -L https://github.com/docker/compose/releases/download/1.10.0/docker-compose-`uname -s`-`uname -m`
$ sudo chmod +x /usr/local/bin/docker-compose
$ sudo usermod -aG docker $USER
```

#### Docker for Windows

- Скачайте [Docker](https://download.docker.com/win/stable/InstallDocker.msi) или [Docker Toolbox](https://github.com/docker/toolbox/releases/tag/v1.12.5):
- Добавьте переменную окружения `COMPOSE_CONVERT_WINDOWS_PATHS` со значением `0`

> Ваш проект должен находиться в директории с пользователем: `C:/Users/<User>/...`. Это важно, иначе не примонтируются директории (не будет прав).
