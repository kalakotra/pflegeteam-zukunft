<% if $Variant == 'boxed' %>
<div class="cta-box" data-bs-theme="dark">
    <div class="cta-box__text">
        <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
        $Heading('cta-box__title')
        <% if $Content %><p class="cta-box__lead mb-0">$Content</p><% end_if %>
    </div>
    <% include CtaButtons Tone='primary', Class='cta-box__actions' %>
</div>
<% else %>
<div class="cta-band text-center">
    <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
    $Heading('cta-band__title')
    <% if $Content %><p class="lead cta-band__lead">$Content</p><% end_if %>
    <% if $IsDarkSection %><% include CtaButtons Tone='primary', Class='justify-content-center mt-4' %><% else %><% include CtaButtons Tone='light', Class='justify-content-center mt-4' %><% end_if %>
</div>
<% end_if %>
