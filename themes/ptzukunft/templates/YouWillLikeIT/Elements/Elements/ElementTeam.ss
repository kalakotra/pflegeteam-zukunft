<div class="team">
    <% if $Heading || $Intro %>
    <header class="team__head">
        $Heading('section-title')
        <% if $Intro %><div class="typography">$Intro</div><% end_if %>
    </header>
    <% end_if %>
    <% if $SortedMembers.exists %>
    <ul class="row g-4 g-lg-5 list-unstyled mb-0 row-cols-1 row-cols-sm-2 row-cols-lg-3">
        <% loop $SortedMembers %>
        <li class="col">
            <article class="team-member">
                <% if $Image.exists %>
                    <% with $Image.Fill(600,720) %>
                    <img class="team-member__image" src="$URL" width="$Width" height="$Height" alt="$Up.ImageAltText.ATT" loading="lazy" decoding="async">
                    <% end_with %>
                <% end_if %>
                <$Up.ChildHeadingTag class="team-member__name">$Name</$Up.ChildHeadingTag>
                <% if $Role %><p class="team-member__role">$Role</p><% end_if %>
                <% if $Bio %><p class="team-member__bio">$Bio</p><% end_if %>
            </article>
        </li>
        <% end_loop %>
    </ul>
    <% end_if %>
    <% include TextLinks Class='mt-5 mb-0' %>
</div>
