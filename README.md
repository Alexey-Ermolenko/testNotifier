# Задача на Yii2

##Требования

###Сделать CRUD с оповещениями, которые можно слать в два интегратора, например sms и telegram.

Модель оповещения:
1. текст сообщения
2. выбор интегратора
3. статус (ожидание, отправлено, ошибка)
4. дата создания
5. дата отправки (ошибки)

Отправку сообщения сделать либо на job, либо на консольной команде (запуск кроном).
Саму интеграцию с telegram и sms писать не нужно, просто функция send() которая возвращает true.

### Запуск

1. git clone https://github.com/Alexey-Ermolenko/testNotifier.git
2. <code>cd project folder</code>
3. <code>docker-compose up -d</code>
4. Перейти в докер контейнер <code> docker exec -ti testtasklocal-phpfpm-1 /bin/sh</code>, где <code>testtasklocal-phpfpm-1</code> - имя контейнера
5. выполнить миграции <code>php yii migrate/up</code>
6. Выполнить команду на запуск оправки сообщений <code>php yii command/send-message</code>
7. Веб-приложение доступно на http://localhost:8083

Через крон, можно будет настроить на сервере подобной командой (Запуск 1 раз в сутки)
<code>0 0 1 0 0 root php /var/www/yii command/send-message</code>


<code>TODO: необходимо доделать миграцию на создание новых тестовых данных модели Notification</code>