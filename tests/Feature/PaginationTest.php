<?php namespace GeneaLabs\LaravelModelCaching\Tests\Feature;

use GeneaLabs\LaravelModelCaching\Tests\FeatureTestCase;
use GeneaLabs\LaravelModelCaching\Tests\Fixtures\Book;
use Illuminate\Support\Str;

class PaginationTest extends FeatureTestCase
{
    public function testPaginationProvidesDifferentLinksOnDifferentPages()
    {
        if (Str::startsWith(app()->version(), "5.6")
            || Str::startsWith(app()->version(), "5.7")
            || Str::startsWith(app()->version(), "5.8")
            || Str::startsWith(app()->version(), "6.0")
        ) {
            $page1ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>';
            $page2ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">2</span></li>';
        }

        if (Str::startsWith(app()->version(), "5.5")) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        if (Str::startsWith(app()->version(), "5.4")) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        $book = (new Book)
            ->take(11)
            ->get()
            ->last();
        $page1 = $this->visit("pagination-test");

        $page1->see($page1ActiveLink);
        $page2 = $page1->click("2");
        $page2->see($page2ActiveLink);
        $page2->see($book->title);
    }

    public function testAdvancedPagination()
    {
        if (Str::startsWith(app()->version(), "5.6")
            || Str::startsWith(app()->version(), "5.7")
            || Str::startsWith(app()->version(), "5.8")
            || Str::startsWith(app()->version(), "6.0")
        ) {
            $page1ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>';
            $page2ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">2</span></li>';
        }

        if (Str::startsWith(app()->version(), "5.5")) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        if (Str::startsWith(app()->version(), "5.4")) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        $response = $this->visit("pagination-test?page[size]=1");

        $response->see($page1ActiveLink);
    }

    public function testCustomPagination()
    {
        if (Str::startsWith(app()->version(), "5.6")
            || Str::startsWith(app()->version(), "5.7")
            || Str::startsWith(app()->version(), "5.8")
            || Str::startsWith(app()->version(), "6.0")
        ) {
            $page1ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>';
            $page2ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">2</span></li>';
        }

        if (Str::startsWith(app()->version(), "5.5")) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        if (Str::startsWith(app()->version(), "5.4")) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        $response = $this->visit("pagination-test2?custom-page=2");

        $response->see($page2ActiveLink);
    }
}
