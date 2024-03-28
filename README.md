# HS Dev Eval

## Setup

A docker file is provided, as well as image uploads and a SQL export for ease of project setup.

### Prerequisites

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Composer](https://getcomposer.org/)
- [Node.js/NPM](https://nodejs.org/en)

### Running the Project

1. Clone the repository
2. Run `docker-compose up` from the root of the project. Consider adding the `-d` argument to run it detached.
3. From the root project directory, run `composer install`. This will install any required WordPress plugins as well as run an NPM command to install dependencies and build assets for the theme.
4. Using the provided phpmyadmin container (http://localhost:8080), dump the tables from the existing WP database and import the SQL export found in the sql-exports directory.
5. Visit `http://localhost` in your browser to access the WordPress site. Admin credentials are `admin:password`

### Architecture and Project Explanation

#### Assumptions Prior to Starting Development

- Due to time constraints, be an native to WordPress as possible, use WordPress provided tooling and packages as much as possible.
- From the get-go, commit to using the block editor exclusively (I knew this might bump me up against the 6hr time constraint).
- In block development use WordPress packages including InnerBlock with native blocks, apiFetch, useData/useDispatch, and native controls.
- Use minimal plugins to achieve specific goals, ACF ease of adding custom fields, Yoast for a baseline SEO and a customizable schema graph.

Because of the commitment to the block editor from the start, I used just one template and developed blocks for aspects of display. I used WordPress's create-block package to scale out the block infrastructure and @wordpress/scripts to build/bundle both the blocks as well as theme js and styles.

#### CPTs and Taxonomies

- Gutter
- Gutter Type (taxonomy for Gutter)
- Testimonial

#### Styles

In absence of knowledge of team's particular style direction, I opted to use SCSS and follow a BEM convention for the most part.

#### JavaScript

For theme scripts, my preference is always to use native JS as opposed to jQuery.

#### Blocks

- Hero block
- Taxonomy cards block
- Testimonials block
- Product info block\*
- Product gallery block\*

\*Note: these blocks were not able to be completed in the 6hr time frame, an explanation can be found below in notes.

### Other Notes

- **Product Info Block**: my goal with this block was to use the Gutenberg data package to store the block settings in the post meta (product description, price, external link for button). This way the block editor could be used exclusively in editing the posts, but were the products to be pulled into other blocks for display on an archive page for instance, the data existed in post meta.
- **Gallery Block**: to achieve the carousel + lightbox implementation, my intention was to re-purpose the native Gutenberg gallery and extend it with [Glide.js](https://glidejs.com/) for the carousel and makeshift a `<dialog>` for the lightbox modal.

**I'm willing to spend more time to complete these blocks if desired, I stopped after the 6hr time limit to preserve the integrity of the test.**
