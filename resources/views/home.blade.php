@extends('layouts.app')

@section('seo')
    @include('components.seo', [
        'title' => config('app.name') . ' — Frontend Developer & Designer',
        'description' => 'Blending thoughtful UI design with clean, responsive development to create websites that look great and perform flawlessly.',
    ])
@endsection

@section('content')

{{-- ============================================================ --}}
{{-- HERO                                                          --}}
{{-- ============================================================ --}}
<section class="site-hero" id="hero" style="background-image: url('{{ asset('images/hero.jpg') }}');">
    <div class="site-hero__container">

        {{-- Left: Content --}}
        <div class="site-hero__content" data-aos="fade-up" data-aos-duration="900">
            <span class="eyebrow">I am {{ config('app.name') }}</span>
            <h1>
                Front-End<br>
                <span>Developer</span> &amp;<br>
                Designer
            </h1>
            <p>
                Blending thoughtful UI design with clean, responsive
                development to create websites that look great and perform
                flawlessly.
            </p>

            <div class="hero-actions">
                <a href="#" class="btn-cv" id="downloadCvBtn">
                    <i class="bi bi-download"></i>
                    Download CV
                </a>
            </div>

            <div class="hero-socials">
                <a href="https://linkedin.com" target="_blank" rel="noopener" title="LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="https://github.com" target="_blank" rel="noopener" title="GitHub">
                    <i class="bi bi-github"></i>
                </a>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================ --}}
{{-- SERVICES                                                      --}}
{{-- ============================================================ --}}
<section class="site-section" id="services">
    <div class="site-section__container">

        <div class="site-section__header" data-aos="fade-up">
            <h2>Services</h2>
            <p>Designing clean scalable responsive websites</p>
        </div>

        <div class="services-grid" data-aos="fade-up" data-aos-delay="100">

            <div class="service-card">
                <h3>UI/UX Website<br>Design</h3>
                <p>Clean, user-focused layouts with clear structure, smooth navigation, and strong visual hierarchy.</p>
                <div class="service-tags">
                    <span class="tag">Modern layouts</span>
                    <span class="tag">Responsive design</span>
                </div>
            </div>

            <div class="service-card">
                <h3>Frontend<br>Development</h3>
                <p>Responsive interfaces using HTML, CSS, and JavaScript for clean, consistent, reliable performance.</p>
                <div class="service-tags">
                    <span class="tag">Clean HTML/CSS</span>
                    <span class="tag">Smooth interactions</span>
                </div>
            </div>

            <div class="service-card">
                <h3>Performance &amp;<br>Responsiveness</h3>
                <p>Fast, mobile-first websites optimized for speed, accessibility, and dependable performance.</p>
                <div class="service-tags">
                    <span class="tag">Speed optimization</span>
                    <span class="tag">Asset efficiency</span>
                </div>
            </div>

            <div class="service-card">
                <h3>WordPress<br>Implementation</h3>
                <p>Lightweight WordPress setups with easy updates, fast loading, and scalable, clean, customizable layouts.</p>
                <div class="service-tags">
                    <span class="tag">Theme setup</span>
                    <span class="tag">Easy management</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- ABOUT ME                                                      --}}
{{-- ============================================================ --}}
<section class="site-section site-section--alt" id="about">
    <div class="site-section__container">

        <div class="site-section__header" data-aos="fade-up">
            <h2>About Me</h2>
        </div>

        <p class="text-center mb-0 mt-0" style="color: var(--site-text-muted); font-size: 0.93rem; line-height: 1.75; max-width: 700px; margin: 0 auto 2rem;" data-aos="fade-up" data-aos-delay="100">
            I'm a front-end developer and designer passionate about crafting clean, intuitive, and responsive digital
            experiences. I focus on turning ideas into seamless interfaces by understanding user needs, designing
            thoughtful UI layouts, and ensuring smooth interactions across devices.
        </p>

        <div data-aos="fade-up" data-aos-delay="150" style="text-align: center; margin-bottom: 0.5rem;">
            <p style="color: var(--site-text-muted); font-size: 0.85rem; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 1rem;">My Approach</p>
        </div>

        <div class="about-approach-grid" data-aos="fade-up" data-aos-delay="200">
            <div class="approach-card">
                <div class="step-num">01</div>
                <span>Understand users &amp; goals</span>
            </div>
            <div class="approach-card">
                <div class="step-num">02</div>
                <span>Create clean UI layouts</span>
            </div>
            <div class="approach-card">
                <div class="step-num">03</div>
                <span>Responsive experiences</span>
            </div>
        </div>

        <div class="about-stats" data-aos="fade-up" data-aos-delay="300">
            <div class="stat">
                <span class="stat-value">02+</span>
                <span class="stat-label">Years Of Experience</span>
            </div>
            <div class="stat">
                <span class="stat-value">15+</span>
                <span class="stat-label">Projects Completed</span>
            </div>
            <div class="stat">
                <span class="stat-value">05+</span>
                <span class="stat-label">Clients Served</span>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================ --}}
{{-- SKILLS                                                        --}}
{{-- ============================================================ --}}
<section class="site-section" id="skills">
    <div class="site-section__container">

        <div class="site-section__header" data-aos="fade-up">
            <h2>Skills</h2>
            <p>Crafting seamless UI/UX and clean code</p>
        </div>

        <div class="skills-grid" data-aos="fade-up" data-aos-delay="100">

            <div class="skill-card">
                <h4>Core Skills</h4>
                <div class="skill-tags">
                    <span class="stag">UI/UX layout</span>
                    <span class="stag">Frontend Dev</span>
                    <span class="stag">Responsive Web Design</span>
                    <span class="stag">Component-Based Design</span>
                </div>
            </div>

            <div class="skill-card">
                <h4>Frontend Tech</h4>
                <div class="skill-tags">
                    <span class="stag">HTML</span>
                    <span class="stag">CSS</span>
                    <span class="stag">JS</span>
                    <span class="stag">WordPress</span>
                    <span class="stag">Laravel</span>
                </div>
            </div>

            <div class="skill-card">
                <h4>Design Tools</h4>
                <div class="skill-tags">
                    <span class="stag">Figma</span>
                    <span class="stag">Photoshop</span>
                    <span class="stag">Illustrator</span>
                </div>
            </div>

            <div class="skill-card">
                <h4>Tools &amp; Interaction</h4>
                <div class="skill-tags">
                    <span class="stag">GitHub</span>
                    <span class="stag">Netlify</span>
                    <span class="stag">GSAP</span>
                    <span class="stag">UI Interactions</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- PROJECTS                                                      --}}
{{-- ============================================================ --}}
<section class="site-section site-section--alt" id="work">
    <div class="site-section__container">

        <div class="site-section__header" data-aos="fade-up">
            <h2>Projects</h2>
            <p>Selected work from the portfolio</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @forelse($projects as $project)
                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                    <a href="{{ route('project.show', $project->slug) }}" class="site-project-card">
                        <div class="card-img-wrapper">
                            <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}">
                        </div>
                        <div class="card-info">
                            <h3>{{ $project->title }}</h3>
                            @if(!empty($project->tech_stack))
                                <div class="tech-tags">
                                    @foreach($project->tech_stack as $tech)
                                        <span class="ttag">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 4rem 0; color: var(--site-text-muted);">
                    <i class="bi bi-folder-x" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.3;"></i>
                    <p>No projects published yet. Check back soon.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

{{-- ============================================================ --}}
{{-- CONTACT                                                       --}}
{{-- ============================================================ --}}
<section class="site-section" id="contact">
    <div class="site-section__container">

        <div class="site-section__header" data-aos="fade-up">
            <h2>Let's work together</h2>
            <p>Have a project in mind? Send me a message and I'll get back to you.</p>
        </div>

        <div data-aos="fade-up" data-aos-delay="150">
            <div class="site-contact-card">
                <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 1.25rem;">
                        <label class="site-label" for="name">Name</label>
                        <input type="text" class="site-input" id="name" name="name" placeholder="Your name" required>
                    </div>
                    <div style="margin-bottom: 1.25rem;">
                        <label class="site-label" for="email">Email</label>
                        <input type="email" class="site-input" id="email" name="email" placeholder="you@example.com" required>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label class="site-label" for="message">Message</label>
                        <textarea class="site-input" id="message" name="message" placeholder="Tell me about your project..." required></textarea>
                    </div>
                    <button type="submit" class="btn-send" id="submitBtn">
                        <span class="btn-text">Send Message</span>
                    </button>
                    <div id="formMessage" class="mt-3 d-none text-center rounded p-3"></div>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
