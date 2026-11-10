<dl class="opening-hours mb-0">
    <% loop $OpeningHoursGrouped %>
    <div class="opening-hours__row"><dt>$Label</dt><dd>$Times</dd></div>
    <% end_loop %>
</dl>
