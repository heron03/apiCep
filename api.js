const fetch = require('node-fetch'); //npm install node-fetch npm i node-fetch@2.6.1
var express = require('express'); //npm install express express-graphql graphql --save --force
var { graphqlHTTP } = require('express-graphql');
var { buildSchema } = require('graphql');
 
var schema = buildSchema(`
  type CEP {
    logradouro: String
    bairro: String
    localidade: String
    uf: String
  }
 
  type Query {
    consultaCep(cep: String!): CEP
  }
`);
 
var root = {
consultaCep: async ({cep}) => {
    let response = await fetch("https://viacep.com.br/ws/"+cep+"/json/")
    if (response.status === 200) {
      return response.json()
    } else {
      throw new Error('Something bad happened :(')
    }    
}
};
 
var app = express();
app.use('/graphql', graphqlHTTP({
  schema: schema,
  rootValue: root,
  graphiql: true,
}));
app.listen(4000);