# Задача 3

## Запуск

### `cd task3`

### `npm install`

### `npm start`

Для выполнения взял болванку React приложения
Добавил в него новый компонент Phone и сервис IpCityService.
IpCityService ходит в https://geolocation-db.com/json/ за определением города по IP, затем в _findPhoneForCity выбирает
из объекта по имени города часть номера.

Иногда вываливается ошибка CORS в консоль браузера, я не знаю почему она возникает через раз, нет времени разбираться.
