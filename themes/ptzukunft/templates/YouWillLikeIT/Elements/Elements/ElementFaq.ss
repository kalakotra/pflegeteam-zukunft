<div class="faq">
    <% if $Heading || $Intro %>
    <header class="faq__head">
        $Heading('section-title')
        <% if $Intro %><div class="typography faq__intro">$Intro</div><% end_if %>
    </header>
    <% end_if %>
    <% if $SortedItems.exists %>
    <div class="faq__items">
        <% loop $SortedItems %>
        <details class="faq__item"<% if $IsFirst %> open<% end_if %> id="faq-$Up.ID-$ID">
            <summary class="faq__question"><span>$Question</span><span class="faq__sign" aria-hidden="true"></span></summary>
            <div class="faq__answer typography">$Answer</div>
        </details>
        <% end_loop %>
    </div>
    <% end_if %>
    <% include TextLinks Class='faq__links mt-4 mb-0' %>
</div>
