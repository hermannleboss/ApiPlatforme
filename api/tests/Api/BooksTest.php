<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Greeting;

class BooksTest extends ApiTestCase
{
    public function testCreateBook()
    {
        $response = static::createClient()->request('POST', '/books', ['json' => [

            "isbn" => "2815840053",
            "description" => "Hello",
            "author" => "Me",
            "publicationDate" => "today"
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([

            "@context" => "/contexts/ConstraintViolationList",
            "@type" => "ConstraintViolationList",
            "hydra:title" => "An error occurred",
            "hydra:description" => "isbn: This value is neither a valid ISBN-10 nor a valid ISBN-13.\ntitle: This value should not be blank.",
            "violations" => [
                [
                    "propertyPath" => "isbn",
                    "message" => "This value is neither a valid ISBN-10 nor a valid ISBN-13.",
                    "code" => "2881c032-660f-46b6-8153-d352d9706640"
                ],
                [
                    "propertyPath" => "title",
                    "message" => "This value should not be blank.",
                    "code" => "c1051bb4-d103-4f74-8988-acbcafc7fdc3"
                ]
            ]
        ]);
    }
}
