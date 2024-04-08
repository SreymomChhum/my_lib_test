## Supported Node.js Versions

This library supports the following PHP implementations:

- Node.js v12.22.12
- Node.js v13.14.0
- Node.js v14.21.3
- Node.js v15.14.0
- Node.js v16.20.2
- Node.js v17.9.1
- Node.js v18.19.1
- Node.js v19.9.0
- Node.js v20.11.1
- Node.js v21.7.1

TypeScript is supported for TypeScript version ^5.4.2

## Installation

`npm install plasgate` or `yarn add plasgate`


## Test your installation

To make sure the installation was successful, try sending yourself an SMS message, like this:

```js
    // Your private key and secret key from plasgate.com
    const privateKey = "your_private_key"
    const secretKey = "your_x-secret_key"

    const client = require("plasgate")(privateKey, secretKey);

    client.messages
    .create({
        to: "+855977804485",
        sender: "SMS Info",
        content: "Welcome to Plasgate SMS gateway",
    }).catch((error) => console.error("Error:", error));
```

## Get started

If you want to familiarize yourself with the project, you can start by [forking the repository](https://help.github.com/articles/fork-a-repo/) and [cloning it in your local development environment](https://help.github.com/articles/cloning-a-repository/). The project requires [Node.js](https://nodejs.org) to be installed on your machine.

After cloning the repository, install the dependencies by running the following command in the directory of your cloned repository:

```bash
npm install
```

You can run the existing tests to see if everything is okay by executing:

```bash
npm test
```


