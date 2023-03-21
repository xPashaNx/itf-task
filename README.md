# Test Task

Для выполнения этого задания и в соответствии с требованиями, 
в качестве решения была взята очередь сообщений с воркерами, 
которые выполняют эмитацию нагрузки и сохранение данных в файл.
В качестве брокера сообщения выступает RabbitMQ.

Управлять кол-вом воркеров можно из конфигурационного файла: [supervisord-programs.conf](client-request-processor%2Fdocker%2Fsupervisord%2Fsupervisord-programs.conf)

Минимальное кол-во воркеров, для выполнение требований необходимо 34 (300 заявок обработает 1 воркер, за 10 минут)

## Запуск
### Создание **.env** файла
    cp client-request-emitter/.env.example client-request-emitter/.env  && cp client-request-processor/.env.example client-request-processor/.env

### Старт контейнеров
    make init
    make up
    
    // use docker
    docker-compose build
    docker-compose up -d

### Установка зависимостей для **client-request-emitter**
    make emitter-composer-install

    // use docker
    docker-compose run --rm client-request-emitter composer install

### Установка зависимостей для **client-request-processor**
    make processor-composer-install

    // use docker
    docker-compose run --rm client-request-processor composer install

### Запуск теста
    processor-run count=10000

    // use docker
    docker-compose run --rm client-request-processor php cli/index.php 10000
