
# Billetera Virtual

Version PHP: 8.3

Framework: Laravel 11

Base de datos: MySQL 8.0.x



## API

#### Registo de Clientes

```http
  POST /api/v1/newCustomer
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `name` | `string` | Nombre.|
| `email` | `string` | Correo electrónico.|
| `cell_phone` | `string` | Celular.|

#### Recarga de billetera

```http
  POST /api/v1/recharge
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `cell_phone` | `string` | Celular.|
| `money` | `string` | Dinero.|

#### Consultar saldo

```http
  GET /api/v1/check
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `cell_phone` | `string` | Celular.|

#### Pagar

```http
  POST /api/v1/pay
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `identification` | `string` | Numero de identificación.|
| `cell_phone` | `string` | Celular.|
| `payment_money` | `string` | Dinero.|

#### Confirmar pago

```http
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
