<?php

namespace Tests\Concerns;

use Laravel\Socialite\Contracts\Factory as Socialite;

trait MocksSocialite
{
    /**
     * Mock the Socialite Factory with a specific provider.
     *
     * @param  string  $provider
     * @return void
     */
    public function mockSocialiteFacade(string $provider)
    {
        $socialiteUser = $this->createMock(\Laravel\Socialite\Two\User::class);

        $methodCallers = [
            'getId' => 1234,
            'getNickname' => 'some-nickname',
            'getName' => 'Rick',
            'getEmail' => 'test@test.com',
            'getAvatar' => 'https://nerdist.com/wp-content/uploads/2020/07/maxresdefault.jpg',
        ];

        foreach ($methodCallers as $method => $return) {
            $socialiteUser->expects($this->any())
                ->method($method)
                ->willReturn($return);
        }

        $socialiteUser->expects($this->any())
            ->method('getRaw')
            ->willReturn([
                'login' => 'some-nickname',
                'id' => 1234,
                'avatar_url' => 'https://nerdist.com/wp-content/uploads/2020/07/maxresdefault.jpg',
                'url' => 'https://api.github.com/users/some-nickname',
                'email' => 'test@test.com',
                'name' => 'Rick',
            ]);

        $provider = $this->createMock($provider);

        $provider->expects($this->any())
            ->method('user')
            ->willReturn($socialiteUser);

        $stub = $this->createMock(Socialite::class);

        $stub->expects($this->any())
            ->method('driver')
            ->willReturn($provider);

        $this->app->instance(Socialite::class, $stub);
    }
}
