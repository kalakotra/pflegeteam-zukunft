$HeaderElement

<% loop $MainElements %>
    $Me
<% end_loop %>

<section class="apply-section section-space bg-light" id="$ApplyAnchor" aria-label="<%t App.Application 'Bewerbung' %>">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-7">
                <% if $ApplicationArea.Elements.Count %>
                    <% loop $ApplicationArea.ElementControllers %>$Me<% end_loop %>
                <% else %>
                    <h2 class="section-title"><%t App.ApplyNow 'Jetzt bewerben' %></h2>
                <% end_if %>
            </div>
            <aside class="col-lg-4 offset-lg-1 apply-aside" aria-label="<%t App.ApplyContact 'Ansprechperson' %>">
                <% if $ContactImage.exists %>
                    <% with $ContactImage.FillMax(640,480) %><img src="$URL" width="$Width" height="$Height" alt="$Up.ContactImageAlt.ATT" loading="lazy" class="apply-aside__image"><% end_with %>
                <% end_if %>
                <% if $ApplyAsideTitle %><h2 class="side-box__title">$ApplyAsideTitle</h2><% end_if %>
                <% if $ApplyAsideText %><p>$ApplyAsideText</p><% end_if %>
                <% if $SiteConfig.Phone %><a class="side-box__phone" href="$SiteConfig.PhoneLink">$SiteConfig.Phone</a><% end_if %>
                <% if $ApplyStepList %>
                <ol class="apply-steps">
                    <% loop $ApplyStepList %><li>$Text</li><% end_loop %>
                </ol>
                <% end_if %>
            </aside>
        </div>
    </div>
</section>

<% loop $BottomArea.ElementControllers %>$Me<% end_loop %>
