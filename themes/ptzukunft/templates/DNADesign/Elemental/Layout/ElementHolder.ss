<section class="element element--$SimpleClassName.LowerCase $Element.SectionClasses<% if $Element.Variant %> element--variant-$Element.Variant<% end_if %><% if $ExtraClass %> $ExtraClass<% end_if %>" id="$Anchor">
    <% if $Element.HasOwnContainer %>
        $Element
    <% else %>
    <div class="$Element.ContainerClass">
        $Element
    </div>
    <% end_if %>
</section>
