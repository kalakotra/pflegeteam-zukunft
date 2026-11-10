<div class="testimonials">
    <% if $Heading || $RatingSummary %>
    <header class="section-head section-head--split">
        <div class="section-head__text">$Heading('section-head__title')</div>
        <% if $RatingSummary %><p class="testimonials__summary"><span class="testimonials__stars" aria-hidden="true">★★★★★</span> $RatingSummary</p><% end_if %>
    </header>
    <% end_if %>
    <% if $SortedItems.exists %>
    <ul class="row g-4 list-unstyled mb-0 row-cols-1 row-cols-md-2">
        <% loop $SortedItems %>
        <li class="col">
            <figure class="testimonial card h-100 mb-0">
                <div class="card-body">
                    <% if $Rating %><p class="testimonial__rating" role="img" aria-label="$RatingLabel.ATT"><span aria-hidden="true">$Stars</span></p><% end_if %>
                    <blockquote class="testimonial__quote mb-0"><p>„$Quote“</p></blockquote>
                    <figcaption class="testimonial__caption">
                        <span class="testimonial__author">$Author</span><% if $Context || $Source %> <span class="testimonial__context">· <% if $Context %>$Context<% end_if %><% if $Context && $Source %>, <% end_if %><% if $Source %>$Source<% end_if %></span><% end_if %>
                    </figcaption>
                </div>
            </figure>
        </li>
        <% end_loop %>
    </ul>
    <% end_if %>
</div>
