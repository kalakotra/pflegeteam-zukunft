<% if $Image.exists %>
<div class="text-media text-media--image-$ImagePosition row g-4 g-lg-5 align-items-center">
    <div class="col-lg-6<% if $ImagePosition == 'right' %> order-lg-2 offset-lg-1<% end_if %>">
        <% with $Image.FillMax(1040,960) %>
        <img class="text-media__image" src="$URL" width="$Width" height="$Height" alt="$Up.ImageAltText.ATT"<% if $Up.IsFirstElement %> fetchpriority="high"<% else %> loading="lazy"<% end_if %> decoding="async">
        <% end_with %>
    </div>
    <div class="col-lg-5<% if $ImagePosition == 'left' %> offset-lg-1<% end_if %> text-media__body">
        <% if $Eyebrow %><p class="kicker">$Eyebrow</p><% end_if %>
        $Heading('section-title')
        <% if $Content %><div class="typography">$Content</div><% end_if %>
        <% include TextLinks Class='mt-4 mb-0' %>
    </div>
</div>
<% else %>
<div class="text-media text-media--statement">
    <% if $Eyebrow %><p class="kicker">$Eyebrow</p><% end_if %>
    $Heading('section-title')
    <% if $Content %><div class="typography">$Content</div><% end_if %>
    <% include TextLinks Class='mt-4 mb-0' %>
</div>
<% end_if %>
