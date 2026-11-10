<section class="element element--$SimpleClassName.LowerCase $Element.SectionClasses<% if $Element.Variant %> element--variant-$Element.Variant<% end_if %><% if $StyleVariant %> $StyleVariant<% end_if %><% if $ExtraClass %> $ExtraClass<% end_if %>" id="$Anchor"<% if $Element.IsDarkSection %> data-bs-theme="dark"<% end_if %>>
    <% if $Element.HasBackgroundImage %>
        <% with $Element.BackgroundImage %>
        <picture class="section__bg" aria-hidden="true">
            <source media="(max-width: 767.98px)" srcset="$FillMax(800,900).URL">
            <img src="$FillMax(1920,1000).URL" width="$FillMax(1920,1000).Width" height="$FillMax(1920,1000).Height" alt="" <% if $Up.Element.IsFirstElement %>fetchpriority="high"<% else %>loading="lazy"<% end_if %>>
        </picture>
        <% end_with %>
    <% end_if %>
    <div class="$Element.ContainerClass">
        $Element
    </div>
</section>
