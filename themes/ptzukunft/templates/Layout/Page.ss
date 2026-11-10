<% if $ElementalArea.Elements.Count %>
    $ElementalArea
<% else %>
<div class="container py-5 py-lg-6">
    $Breadcrumbs
    <h1 class="mt-3">$Title</h1>
    <div class="typography container-narrow px-0 ms-0">$Content</div>
    $Form
</div>
<% end_if %>
