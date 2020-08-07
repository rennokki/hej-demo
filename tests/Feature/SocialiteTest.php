<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class SocialiteTest extends TestCase
{
    public function test_redirect_should_redirect_to_provider_website()
    {
        // Call the redirect with Github as provider
        // and expect to be a 302 redirect.

        $response = $this
            ->call('GET', route('social.redirect', ['provider' => 'github']))
            ->assertStatus(302);

        // Get the target URL (the URL the user will be redirected to)
        // and you can test it further...

        $targetUrl = $response->getTargetUrl();

        dump("Going to: {$targetUrl}");
    }

    public function test_register_using_socialite()
    {
        // Mock the GithubProvider facade.

        $this->mockSocialiteFacade(
            \Laravel\Socialite\Two\GithubProvider::class
        );

        // Call directly the /callback route.

        $this
            ->call('GET', route('social.callback', ['provider' => 'github']))
            ->assertStatus(302);

        $this->assertNotNull(
            $user = User::whereEmail('test@test.com')->first()
        );

        $this->assertCount(
            1, $user->socials()->get()
        );

        $social = $user->socials()->first();

        $expected = [
            'provider' => 'github',
            'provider_id' => '1234',
            'provider_nickname' => 'some-nickname',
            'provider_name' => 'Rick',
            'provider_email' => 'test@test.com',
            'provider_avatar' => 'https://nerdist.com/wp-content/uploads/2020/07/maxresdefault.jpg',
        ];

        $existingData = $social->setHidden([])->toArray();

        // Make sure the existing data matches with the Socialite data.

        foreach ($expected as $key => $value) {
            $this->assertEquals(
                $existingData[$key], $value
            );
        }
    }
}
