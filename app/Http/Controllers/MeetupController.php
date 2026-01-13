<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Category;
use App\Models\Event;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class MeetupController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')
            ->where('template', 'home')
            ->published()
            ->first();

        $teamMembers = TeamMember::published()
            ->ordered()
            ->get();

        $services = Service::published()
            ->ordered()
            ->take(6)
            ->get();

        $portfolios = Portfolio::with(['category', 'media'])
            ->published()
            ->ordered()
            ->take(10)
            ->get();

        $testimonials = Testimonial::published()
            ->ordered()
            ->get();

        $partners = Partner::published()
            ->ordered()
            ->get();

        $events = Event::with(['schedules', 'upcomingDates'])
            ->published()
            ->ordered()
            ->get();

        return view('meetup.home', compact(
            'page',
            'teamMembers',
            'services',
            'portfolios',
            'testimonials',
            'partners',
            'events'
        ));
    }

    public function services()
    {
        $services = Service::published()
            ->ordered()
            ->get();

        return view('meetup.services', compact('services'));
    }

    public function showService(string $locale, string $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        if (!$service->is_published) {
            abort(404);
        }

        $otherServices = Service::published()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('meetup.service-detail', compact('service', 'otherServices'));
    }

    public function portfolio()
    {
        $portfolios = Portfolio::with(['category', 'media'])
            ->published()
            ->ordered()
            ->get();

        $partners = Partner::published()
            ->ordered()
            ->get();

        $awards = Award::published()
            ->ordered()
            ->get();

        $testimonials = Testimonial::published()
            ->ordered()
            ->get();

        return view('meetup.portfolio', compact('portfolios', 'partners', 'awards', 'testimonials'));
    }

    public function showPortfolio(string $locale, string $slug)
    {
        $portfolio = Portfolio::with(['category', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();

        if (!$portfolio->is_published) {
            abort(404);
        }

        $otherPortfolios = Portfolio::with(['media'])
            ->published()
            ->where('id', '!=', $portfolio->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('meetup.portfolio-detail', compact('portfolio', 'otherPortfolios'));
    }

    public function team()
    {
        $leaders = TeamMember::published()
            ->leaders()
            ->ordered()
            ->get();

        $teamMembers = TeamMember::published()
            ->members()
            ->ordered()
            ->get();

        return view('meetup.team', compact('leaders', 'teamMembers'));
    }

    public function showTeamMember(string $locale, string $slug)
    {
        $member = TeamMember::where('slug', $slug)->firstOrFail();

        if (!$member->is_published) {
            abort(404);
        }

        $otherMembers = TeamMember::published()
            ->where('id', '!=', $member->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('meetup.team-detail', compact('member', 'otherMembers'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')
            ->where('template', 'about')
            ->published()
            ->firstOrFail();

        return view('meetup.about', compact('page'));
    }

    public function contact()
    {
        $page = Page::where('slug', 'contact')
            ->where('template', 'contact')
            ->published()
            ->firstOrFail();

        $services = Service::published()
            ->ordered()
            ->get();

        return view('meetup.contact', compact('page', 'services'));
    }

    public function blog()
    {
        $page = Page::where('slug', 'blog')
            ->where('template', 'blog-page')
            ->published()
            ->first();

        $posts = Post::with(['category', 'categories', 'media'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = Category::withCount(['posts' => function ($query) {
            $query->published();
        }])->orderBy('order')->get();

        $recentPosts = Post::with(['media'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('meetup.blog', compact('page', 'posts', 'categories', 'recentPosts'));
    }

    public function showPost(string $locale, string $slug)
    {
        $post = Post::with(['category', 'categories', 'author', 'media', 'widgets'])
            ->where('slug', $slug)
            ->firstOrFail();

        if (!$post->is_published || ($post->published_at && $post->published_at->isFuture())) {
            abort(404);
        }

        $post->incrementViews();

        $page = Page::where('slug', 'blog-detail')
            ->where('template', 'blog-detail')
            ->published()
            ->first();

        $relatedPosts = Post::with(['media'])
            ->published()
            ->where('id', '!=', $post->id)
            ->where(function ($query) use ($post) {
                if ($post->category_id) {
                    $query->where('category_id', $post->category_id);
                }
            })
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('meetup.blog-detail', compact('post', 'page', 'relatedPosts'));
    }

    public function events()
    {
        $page = Page::where('slug', 'events')
            ->where('template', 'events-page')
            ->published()
            ->first();

        $events = Event::with(['schedules', 'upcomingDates', 'media'])
            ->published()
            ->ordered()
            ->get();

        // Auto-generate slugs for events that don't have them
        foreach ($events as $event) {
            $event->saveGeneratedSlugs();
        }

        return view('meetup.events', compact('page', 'events'));
    }

    public function showEvent(string $locale, string $slug)
    {
        // Search by slug in translations - try all locales
        $event = Event::with(['schedules', 'upcomingDates', 'widgets', 'media'])
            ->where(function ($query) use ($slug) {
                $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(translations, '$.ru.slug')) = ?", [$slug])
                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(translations, '$.en.slug')) = ?", [$slug])
                    ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(translations, '$.az.slug')) = ?", [$slug]);
            })
            ->first();

        // Fallback: search by id
        if (!$event && is_numeric($slug)) {
            $event = Event::with(['schedules', 'upcomingDates', 'widgets', 'media'])
                ->find($slug);
        }

        if (!$event) {
            abort(404);
        }

        if (!$event->is_published) {
            abort(404);
        }

        $page = Page::where('slug', 'event-detail')
            ->where('template', 'event-detail')
            ->published()
            ->first();

        $otherEvents = Event::with(['upcomingDates'])
            ->published()
            ->where('id', '!=', $event->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('meetup.event-detail', compact('event', 'page', 'otherEvents'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'service' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        // TODO: Implement email sending or database storage

        return back()->with('success', __('contact.page.success_message'));
    }
}
