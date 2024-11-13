<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_get_topics_and_questions_response(): void
    {
        $response = $this->getJson('/api/getQuestions');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'topic_name',
                'questions' => [
                    '*' => [
                        'question_id',
                        'difficulty'
                    ]
                ]
            ]
        ]);
    }

    public function test_get_answers_response(): void
    {
        $response = $this->getJson('/api/getAnswers/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'answer_text'
            ]
        ]);
    }

    public function test_check_answer(): void
    {
        $response = $this->getJson('/api/checkAnswer/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'is_correct'
            ]
        ]);
    }
    public function test_empty_check_answer_response(): void
    {
        $response = $this->get('/api/checkAnswer/-1');
        $response->assertSee('Answer not found');
        $response->assertStatus(500);
    }
    public function test_empty_answers_response(): void
    {
        $response = $this->get('/api/getAnswers/-1');
        $response->assertSee('Answer not found');
        $response->assertStatus(500);
    }
}
