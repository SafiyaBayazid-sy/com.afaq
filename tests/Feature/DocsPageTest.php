<?php

namespace Tests\Feature;

use Tests\TestCase;

class DocsPageTest extends TestCase
{
    public function test_docs_home_page_is_available_and_organized(): void
    {
        $response = $this->get('/docs');

        $response
            ->assertOk()
            ->assertSee('AFAQ Docs Hub')
            ->assertSee('Interactive API Reference')
            ->assertSee('Mobile Team Quickstart')
            ->assertSee('Postman Collection');
    }

    public function test_docs_guide_page_can_render_text_document(): void
    {
        $response = $this->get('/docs/guides/quickstart');

        $response
            ->assertOk()
            ->assertSee('Mobile Team Quickstart')
            ->assertSee('AFAQ Customer API Quickstart');
    }
}
