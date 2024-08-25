<?php

namespace App\Infrastructure\Trait;

use App\Domain\Models\Actor\Actor;
use App\Domain\Models\Category\Category;
use App\Domain\Models\Film\Film;
use App\Domain\Models\Ticket\Ticket;
use App\Domain\Models\User\User;

trait TestTrait
{
    public function createData(): void
    {
        $this->createUsers();

        $this->createCategories();

        $this->createActors();

        $this->createFilms();

        $this->createTickets();
    }

    public function createUsers(): void
    {
        $user_one = new User;

        $user_one->name = 'test';
        $user_one->email = 'test@mail.ru';
        $user_one->password = 'test';
        $user_one->save();

        $user_two = new User;

        $user_two->name = 'test';
        $user_two->email = 'test2@mail.ru';
        $user_two->password = 'test';
        $user_two->save();
    }

    public function createCategories(): void
    {
        $category_one = new Category;

        $category_one->name = 'fantasy';
        $category_one->save();

        $category_two = new Category;

        $category_two->name = 'horror';
        $category_two->save();
    }

    public function createActors(): void
    {
        $actor_one = new Actor;

        $actor_one->name = 'John';
        $actor_one->save();

        $actor_two = new Actor;

        $actor_two->name = 'Mike';
        $actor_two->save();
    }

    public function createFilms(): void
    {
        $film_one = new Film;

        $film_one->name = 'test';
        $film_one->save();
        $film_one->categories()->sync([1]);
        $film_one->actors()->sync([2]);

        $film_two = new Film;

        $film_two->name = 'test';
        $film_two->save();
        $film_two->categories()->sync([2]);
        $film_two->actors()->sync([1]);
    }

    public function createTickets(): void
    {
        $ticket_one = new Ticket;

        $ticket_one->film_id = 1;
        $ticket_one->price = 1000;
        $ticket_one->seat = 'F41';
        $ticket_one->save();

        $ticket_two = new Ticket;

        $ticket_two->film_id = 2;
        $ticket_two->price = 1000;
        $ticket_two->seat = 'F32';
        $ticket_two->save();
    }
}
