<section class="author-profile">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="author-card-wide">
                    <div class="author-main">
                        <div class="author-avatar-large">
                            <a href="{{ route('frontend.user', $user->username) }}">
                                <img src="{{ asset('uploads/author/'.($user->profile ?? 'default.webp')) }}" alt="{{ $user->name }}" />
                            </a>
                        </div>
                        <div class="author-heading">
                            <h2 class="author-name">{{ $user->name }}</h2>
                            <div class="author-social">
                                @if ($user->facebook)
                                <a href="{{ $user->facebook }}" target="_blank" class="social-link">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                @endif
                                @if ($user->twitter)
                                <a href="{{ $user->twitter }}" target="_blank" class="social-link">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                @endif
                                @if ($user->instagram)
                                <a href="{{ $user->instagram }}" target="_blank" class="social-link">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                @endif
                                @if ($user->linkedin)
                                <a href="{{ $user->linkedin }}" target="_blank" class="social-link">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                @endif
                                @if ($user->youtube)
                                <a href="{{ $user->youtube }}" target="_blank" class="social-link">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($user->about)
                    <div class="author-about">
                        <p>{{ $user->about }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Main Container */
    .author-profile {
        padding: 50px 0;
    }

    /* Author Card */
    .author-card-wide {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .author-card-wide:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
    }

    /* Top Section */
    .author-main {
        display: flex;
        align-items: center;
        gap: 30px;
        padding: 40px;
    }

    /* Avatar */
    .author-avatar-large {
        flex: 0 0 160px;
    }

    .author-avatar-large img {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .author-avatar-large:hover img {
        transform: scale(1.03);
        border-color: rgba(255, 255, 255, 0.5);
    }

    /* Heading */
    .author-heading {
        flex: 1;
    }

    .author-name {
        color: #fff;
        font-size: 32px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    /* About Section */
    .author-about {
        background: rgba(255, 255, 255, 0.08);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 30px 40px;
    }

    .author-about p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 16px;
        line-height: 1.8;
        margin: 0;
    }

    /* Social Links */
    .author-social {
        display: flex;
        gap: 12px;
    }

    .social-link {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .author-main {
            padding: 30px;
        }

        .author-about {
            padding: 25px 30px;
        }
    }

    @media (max-width: 768px) {
        .author-main {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .author-social {
            justify-content: center;
        }

        .author-name {
            font-size: 28px;
        }
    }

    @media (max-width: 576px) {
        .author-main {
            padding: 25px;
        }

        .author-avatar-large {
            flex: 0 0 120px;
        }

        .author-avatar-large img {
            width: 120px;
            height: 120px;
        }

        .author-about {
            padding: 20px 25px;
        }

        .author-about p {
            font-size: 15px;
        }
    }
</style>
