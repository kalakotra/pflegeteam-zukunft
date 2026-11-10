$HeaderElement

<% loop $MainElements %>
    $Me
<% end_loop %>

<section class="apply-section py-6 py-lg-7" id="$ApplyAnchor" aria-label="<%t App.Application 'Bewerbung' %>">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-7">
                <div class="apply-card">
                    <% if $ApplicationArea.Elements.Count %>
                        <% loop $ApplicationArea.ElementControllers %>$Me<% end_loop %>
                    <% else %>
                        <h2><%t App.ApplyNow 'Jetzt bewerben' %></h2>
                    <% end_if %>
                </div>
            </div>
            <aside class="col-lg-5 apply-aside" aria-label="<%t App.ApplyContact 'Ansprechperson' %>">
                <% if $ContactImage.exists %>
                    <% with $ContactImage.FillMax(640,420) %><img src="$URL" width="$Width" height="$Height" alt="$Up.ContactImageAlt.ATT" loading="lazy" class="apply-aside__image"><% end_with %>
                <% end_if %>
                <% if $ApplyAsideTitle %><h2 class="h3">$ApplyAsideTitle</h2><% end_if %>
                <% if $ApplyAsideText %><p>$ApplyAsideText</p><% end_if %>
                <% if $SiteConfig.Phone %><a href="$SiteConfig.PhoneLink" class="btn btn-outline-primary btn-lg"><% include Icon Name='phone', Class='icon-sm' %>$SiteConfig.Phone</a><% end_if %>
                <% if $ApplyStepList %>
                <ol class="apply-steps list-unstyled">
                    <% loop $ApplyStepList %><li><span class="apply-steps__no" aria-hidden="true">$Pos</span>$Text</li><% end_loop %>
                </ol>
                <% end_if %>
            </aside>
        </div>
    </div>
</section>

$BottomArea
