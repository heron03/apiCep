<?php
require('vendor\autoload.php');


use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

function consultaCep($cep = null)
{
    $response = file_get_contents('https://viacep.com.br/ws/' . $cep . '/json');
    $retorno = json_decode($response);
    return $retorno;
}


try {
    $queryType = new ObjectType([
        'name' => 'Query',
        'fields' => [
            'cep' => [
                'type' => Type::string(),
                'args' => [
                    'message' => ['type' => Type::string()],
                ],
                'resolve' => static fn ($rootValue, array $args): string => $rootValue['prefix'] . $args['message'],
            ],
        ],
    ]);


    // See docs on schema options:
    // https://webonyx.github.io/graphql-php/schema-definition/#configuration-options
    $schema = new Schema([
        'query' => $queryType,
    ]);

    $rawInput = file_get_contents('php://input');
    if ($rawInput === false) {
        throw new RuntimeException('Failed to get php://input');
    }

    $input = json_decode($rawInput, true);
    $query = $input['query'];
    $variableValues = $input['variables'] ?? null;
    $rootValue = ['prefix' => ''];
    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $cep = $result->toArray()['data']['cep'];
    $retorno = consultaCep($cep);
    $output = $retorno;
} catch (Throwable $e) {
    $output = [
        'error' => [
            'message' => $e->getMessage(),
        ],
    ];
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);

