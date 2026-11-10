<div class="team">
    <% if $Heading || $Intro %>
    <header class="section-head">
        <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
        $Heading('section-head__title')
        <% if $Intro %><div class="typography section-head__intro">$Intro</div><% end_if %>
    </header>
    <% end_if %>
    <% if $SortedMembers.exists %>
    <ul class="row g-4 list-unstyled mb-0 row-cols-1 row-cols-sm-2 row-cols-lg-3">
        <% loop $SortedMembers %>
        <li class="col">
            <article class="team-member card h-100">
                <% if $Image.exists %>
                    <% with $Image.Fill(600,600) %>
                    <img class="card-img-top" src="$URL" width="$Width" height="$Height" alt="$Up.ImageAltText.ATT" loading="lazy" decoding="async">
                    <% end_with %>
                <% else %>
                    <span class="team-member__placeholder" aria-hidden="true"><% include Icon Name='user' %></span>
                <% end_if %>
                <div class="card-body">
                    <$Up.ChildHeadingTag class="team-member__name">$Name</$Up.ChildHeadingTag>
                    <% if $Role %><p class="team-member__role">$Role</p><% end_if %>
                    <% if $Bio %><p class="team-member__bio mb-0">$Bio</p><% end_if %>
                </div>
            </article>
        </li>
        <% end_loop %>
    </ul>
    <% end_if %>
    <% include CtaButtons Tone='light', Class='mt-5' %>
</div>
