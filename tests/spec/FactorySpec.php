<?php

namespace spec\Amaiza\Marketo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('make', ['demo']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Amaiza\Marketo\HubSpotService');
    }

    function it_throws_a_hubspot_exception_from_uninstantiable_api_class()
    {
        $this->shouldThrow('\Amaiza\Marketo\Exceptions\HubSpotException')->during('api');
    }

    function it_throws_a_reflection_exception_from_nonexistent_api_class()
    {
        $this->shouldThrow('\ReflectionException')->during('doesntExist');
    }

    function it_creates_a_blogs_api_class()
    {
        $this->blogs()->shouldHaveType('Amaiza\Marketo\Api\Blogs');
    }

    function it_creates_a_blogAuthors_api_class()
    {
        $this->blogAuthors()->shouldHaveType('Amaiza\Marketo\Api\BlogAuthors');
    }

    function it_creates_a_blogPosts_api_class()
    {
        $this->blogPosts()->shouldHaveType('Amaiza\Marketo\Api\BlogPosts');
    }

    function it_creates_a_blogTopics_api_class()
    {
        $this->blogTopics()->shouldHaveType('Amaiza\Marketo\Api\BlogTopics');
    }

    function it_creates_a_contacts_api_class()
    {
        $this->contacts()->shouldHaveType('Amaiza\Marketo\Api\Contacts');
    }

    function it_creates_a_contactLists_api_class()
    {
        $this->contactLists()->shouldHaveType('Amaiza\Marketo\Api\ContactLists');
    }

    function it_creates_a_contactProperties_api_class()
    {
        $this->contactProperties()->shouldHaveType('Amaiza\Marketo\Api\ContactProperties');
    }

    function it_creates_a_email_api_class()
    {
        $this->email()->shouldHaveType('Amaiza\Marketo\Api\Email');
    }

    function it_creates_a_emailEvents_api_class()
    {
        $this->emailEvents()->shouldHaveType('Amaiza\Marketo\Api\EmailEvents');
    }

    function it_creates_a_files_api_class()
    {
        $this->files()->shouldHaveType('Amaiza\Marketo\Api\Files');
    }

    function it_creates_a_forms_api_class()
    {
        $this->forms()->shouldHaveType('Amaiza\Marketo\Api\Forms');
    }

    function it_creates_a_keywords_api_class()
    {
        $this->keywords()->shouldHaveType('Amaiza\Marketo\Api\Keywords');
    }

    function it_creates_a_marketPlace_api_class()
    {
        $this->marketPlace()->shouldHaveType('Amaiza\Marketo\Api\MarketPlace');
    }

    function it_creates_a_pages_api_class()
    {
        $this->pages()->shouldHaveType('Amaiza\Marketo\Api\Pages');
    }

    function it_creates_a_socialMedia_api_class()
    {
        $this->socialMedia()->shouldHaveType('Amaiza\Marketo\Api\SocialMedia');
    }

    function it_creates_a_workflows_api_class()
    {
        $this->workflows()->shouldHaveType('Amaiza\Marketo\Api\Workflows');
    }

    function it_creates_an_events_api_class()
    {
        $this->events()->shouldHaveType('Amaiza\Marketo\Api\Events');
    }

    function it_creates_a_company_properties_api_class()
    {
        $this->companyProperties()->shouldHaveType('Amaiza\Marketo\Api\CompanyProperties');
    }
}
