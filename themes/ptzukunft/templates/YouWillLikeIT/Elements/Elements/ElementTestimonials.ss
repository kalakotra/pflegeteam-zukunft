<div class="quotes quotes--$Variant">
    <% if $Heading %><div class="visually-hidden">$Heading</div><% end_if %>
    <% loop $VisibleItems %>
    <figure class="quote">
        <blockquote class="quote__text"><p>„$Quote“</p></blockquote>
        <figcaption class="quote__caption">$Author<% if $Context %>, $Context<% end_if %><% if $Source %> · $Source<% end_if %></figcaption>
    </figure>
    <% end_loop %>
</div>
