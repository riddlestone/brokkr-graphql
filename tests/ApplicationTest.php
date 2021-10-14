<?php

namespace Riddlestone\Brokkr\GraphQL\Test;

use Exception;
use GraphQL\Type\Definition\StringType;
use GraphQL\Type\Schema;
use Laminas\Http\Request;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Riddlestone\Brokkr\GraphQL\GraphQLFieldManager;
use Riddlestone\Brokkr\GraphQL\GraphQLTypeManager;
use Riddlestone\Brokkr\GraphQL\Test\Classes\HelloField;

class ApplicationTest extends AbstractHttpControllerTestCase
{
    protected function setUp(): void
    {
        $this->setApplicationConfig(
            require __DIR__ . '/test-application/config/application.php'
        );
        parent::setUp();
    }

    public function testFieldPluginManager(): void
    {
        $this->assertTrue($this->getApplicationServiceLocator()->has('GraphQLFieldManager'));
        /** @var GraphQLFieldManager $fieldManager */
        $fieldManager = $this->getApplicationServiceLocator()->get('GraphQLFieldManager');
        $this->assertTrue($fieldManager->has(HelloField::class));
        /** @var HelloField $field */
        $field = $fieldManager->get(HelloField::class);
        $this->assertInstanceOf(HelloField::class, $field);
        $this->assertSame($field, $fieldManager->get(HelloField::class));
        $this->assertSame([$field], $fieldManager->getQueryFields());
    }

    public function testTypePluginManager(): void
    {
        $this->assertTrue($this->getApplicationServiceLocator()->has('GraphQLTypeManager'));
        /** @var GraphQLTypeManager $typeManager */
        $typeManager = $this->getApplicationServiceLocator()->get('GraphQLTypeManager');
        $this->assertTrue($typeManager->has('string'));
        /** @var StringType $type */
        $type = $typeManager->get('string');
        $this->assertInstanceOf(StringType::class, $type);
        $this->assertSame($type, $typeManager->get('string'));
    }

    public function testSchema(): void
    {
        $this->assertTrue($this->getApplicationServiceLocator()->has(Schema::class));
        $this->assertInstanceOf(Schema::class, $this->getApplicationServiceLocator()->get(Schema::class));
    }

    /**
     * @dataProvider requestsAndResponses
     * @throws Exception
     */
    public function testResponses(string $requestString, int $responseCode, string $responseString): void
    {
        /** @var Request $request */
        $request = $this->getRequest();
        $request->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $this->dispatch('/graphql', 'POST', ['query' => 'query ' . $requestString]);
        $this->assertResponseStatusCode($responseCode);
        $this->assertEquals('{"data":' . $responseString . '}', $this->getResponse()->getContent());
    }

    public function requestsAndResponses(): array
    {
        return [
            ['{ hello }', 200, '{"hello":"Hello World!"}'],
            ['{ hi: hello }', 200, '{"hi":"Hello World!"}'],
        ];
    }
}
