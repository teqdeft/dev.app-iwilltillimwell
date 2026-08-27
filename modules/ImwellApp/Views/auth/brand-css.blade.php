{{--
    Organisation branding for the sign-in / activation screens.

    The project's login stylesheet sizes the logo box at a fixed 141x113 and
    uses object-fit:cover, which crops a wide organisation logo (a wordmark
    loses its first and last letters). Organisation logos vary in shape, so
    here the box is flexible and the image is contained rather than cropped.
--}}
<style>
    .lotin-card-web .top-section .logo.org-logo {
        position: static;
        width: auto;
        height: auto;
        max-width: 240px;
        min-height: 64px;
        margin: 0 auto 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lotin-card-web .top-section .logo.org-logo img {
        position: static;
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: 96px;
        object-fit: contain;     /* never crop an organisation wordmark */
    }

    .lotin-card-web .top-section .title h1.web-t {
        line-height: 1.3;
        word-break: break-word;
    }

    .lotin-card-web .top-section .title p {
        margin: 6px 0 0;
        font-size: 14px;
        color: #6b7280;
    }

    @media (max-width: 767px) {
        .lotin-card-web .top-section .logo.org-logo {
            max-width: 190px;
            min-height: 54px;
        }
        .lotin-card-web .top-section .logo.org-logo img { max-height: 76px; }
    }
</style>
