<title>$SeoTitle</title>
$MetaTags(false)
<link rel="canonical" href="$AbsoluteLink">
<% if $NoIndex %><meta name="robots" content="noindex, follow"><% end_if %>
<meta property="og:type" content="<% if $ClassName.ShortName == 'HomePage' %>website<% else %>article<% end_if %>">
<meta property="og:site_name" content="$SiteConfig.Title.ATT">
<meta property="og:title" content="$SeoTitle.ATT">
<% if $SeoDescription %>
<meta property="og:description" content="$SeoDescription.ATT">
<meta name="twitter:description" content="$SeoDescription.ATT">
<% end_if %>
<meta property="og:url" content="$AbsoluteLink">
<meta property="og:locale" content="$OGLocale">
<% if $SocialImage %>
<% with $SocialImage.Fill(1200,630) %>
<meta property="og:image" content="$AbsoluteURL">
<meta property="og:image:width" content="$Width">
<meta property="og:image:height" content="$Height">
<meta name="twitter:image" content="$AbsoluteURL">
<% end_with %>
<% end_if %>
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="$SeoTitle.ATT">
<%-- JSON-LD (Organization, MedicalBusiness, WebSite, WebPage, BreadcrumbList, Service, JobPosting, FAQPage, …) is injected
     by dorsetdigital/silverstripe-schema-manager (response middleware). Do not add it here. --%>
