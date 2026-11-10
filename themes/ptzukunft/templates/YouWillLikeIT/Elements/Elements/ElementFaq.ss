<div class="faq faq--$Layout">
    <div class="row g-4 g-lg-5">
        <% if $Heading || $Intro || $Eyebrow %>
        <header class="<% if $Layout == 'intro-left' %>col-lg-5<% else %>col-12 text-lg-center<% end_if %> faq__head">
            <% if $Eyebrow %><p class="eyebrow">$Eyebrow</p><% end_if %>
            $Heading('faq__title')
            <% if $Intro %><div class="typography faq__intro">$Intro</div><% end_if %>
            <% if $Layout == 'intro-left' && $SideImage.exists %>
                <% with $SideImage.FillMax(720,480) %>
                <img class="faq__image" src="$URL" width="$Width" height="$Height" alt="$Up.SideImageAlt.ATT" loading="lazy" decoding="async">
                <% end_with %>
            <% end_if %>
            <% if $Layout == 'intro-left' %><% include CtaButtons Tone='light', Class='mt-4' %><% end_if %>
        </header>
        <% end_if %>
        <% if $SortedItems.exists %>
        <div class="<% if $Layout == 'intro-left' %>col-lg-7<% else %>col-lg-9 col-xl-8 mx-auto<% end_if %>">
            <div class="faq__items">
                <% loop $SortedItems %>
                <details class="faq__item"<% if $IsFirst %> open<% end_if %> id="faq-$Up.ID-$ID">
                    <summary class="faq__question"><span>$Question</span><% include Icon Name='chevron', Class='faq__chevron' %></summary>
                    <div class="faq__answer typography">$Answer</div>
                </details>
                <% end_loop %>
            </div>
            <% if $Layout != 'intro-left' %><% include CtaButtons Tone='light', Class='justify-content-center mt-4' %><% end_if %>
        </div>
        <% end_if %>
    </div>
</div>
