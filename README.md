
# Billetera Virtual

Version PHP: 8.3

Framework: Laravel 11

Base de datos: MySQL 8.0.x



## API

Los parametros se envian en formato JSON
```
{
    "identification": 1234567890,
    "cell_phone": 1224467990
}
```
Y su respuesta es en JSON
```
{
    "success": true,
    "cod_error": 0,
    "message_error": "",
    "msg": "Saldo en la billetera virtual",
    "data": {
        "data": {
            "money": "100"
        }
    }
}
```

#### Registo de Clientes

```
  POST /api/v1/newCustomer
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `name` | `string` | Nombre.|
| `email` | `string` | Correo electrónico.|
| `cell_phone` | `string` | Celular.|

#### Recarga de billetera

```
  POST /api/v1/recharge
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `cell_phone` | `string` | Celular.|
| `money` | `string` | Dinero.|

#### Consultar saldo

```
  GET /api/v1/check
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `cell_phone` | `string` | Celular.|

#### Pagar

```
  POST /api/v1/pay
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `cell_phone` | `string` | Celular.|
| `payment_money` | `string` | Dinero.|

#### Confirmar pago

```
  GET /api/v1/confirmPayment
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `cell_phone` | `string` | Celular.|
| `payment_money` | `string` | Dinero.|

**Para confirmar el pago tambien se debe usar el token previamente generado en la funcionalidad Pagar. Este se debe usar como un Bearer Token**


## Autor

Fabian Alejandro Otalora Silva

Desarrollador de Software 🇨🇴

[@fabian-otalora](https://www.github.com/fabian-otalora)



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
