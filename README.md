<h1 align="center">PETSHOP API</h1>


## About Petshop API

To generate a private key, run the following command:
`openssl genrsa -out storage/jwt/jwtRS256.pem 2048
`

To generate a new public key, run the following command:
`openssl rand -base64 32`

The JWT Token issuer is the API server domain, this url is picked from the `.env` file in the root directory.
So, endeavor to set the `APP_URL` to the api of your local server so the JWT Token service pick the right URL.

