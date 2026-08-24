
<?php 
    $getSegment = Request::segment(1);
    $getSegment2 = Request::segment(2);
    if(isset($getSegment2)) {
        $getSegment = $getSegment . "/" . $getSegment2;
    }
	$tags = setMetaTags($getSegment);
?>

<!-- Start of dynamic meta tags  -->
    <title>Iwilltilimwell</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="dKpkh3uetv3mXFGnJ0Z8d2zrTyq8dJFW4UQJHglFDF4" />

    <meta name="title" content="<?= isset($tags['title']) ? htmlspecialchars($tags['title']) : 'iwilltilimwell' ?>">
    <meta name="description" content="<?= isset($tags['description']) ? htmlspecialchars($tags['description']) : 'iwilltilimwell' ?>">
    <meta name="keywords" content="<?= isset($tags['keywords']) ? htmlspecialchars($tags['keywords']) : 'iwilltilimwell' ?>">
<!-- End of dynamic meta tags -->

<?php
// Function to set meta tags based on URL segment
function setMetaTags($getSegment)
{
    $title = "";
    $description = "";
    $keywords = "";

    switch ($getSegment) {
        case "counseling":
            $title = "Counseling Services | I will Till I am Well";
            $description = "Experienced counseling services to help you navigate life's challenges. Individual, couples, and family therapy available.";
            $keywords = "counseling, therapy, mental health, psychotherapy, counseling services";
            break;

        case "tele-counseling":
            $title = "Teletherapy Services | I will Till I am Well";
            $description = "Professional teletherapy services for individuals, couples, and families. Connect with licensed therapists online for mental health support and counselling.";
            $keywords = "teletherapy, online counseling, virtual therapy, remote therapy, mental health services";
            break;

        case "working-anxiety":
            $title = "Anxiety Support and Resources | Working Anxiety";
            $description = "Comprehensive anxiety support and resources. Find information, coping strategies, and professional guidance to manage anxiety effectively.";
            $keywords = "anxiety, mental health, anxiety support, anxiety resources, coping strategies, anxiety management";
            break;

        case "hgealthy-boundaries":
            $title = "Healthy Boundaries: Setting, Maintaining & Respecting Personal Limits";
            $description = "Explore the importance of healthy boundaries in relationships and personal well-being. Learn effective strategies for setting, communicating, and maintaining boundaries for a more balanced and fulfilling life.";
            $keywords = "healthy boundaries, setting boundaries, personal limits, relationship boundaries, boundary-setting strategies";
            break;

        case "grief-loss":
            $title = "Grief and Loss Support: Navigating the Journey of Healing";
            $description = "Comprehensive resources and support for individuals coping with grief and loss. Explore ways to navigate the emotional journey, find healing strategies, and connect with a community of understanding individuals.";
            $keywords = "grief, loss, bereavement, coping with loss, grief support, healing after loss";
            break;

        case "emotion-regulation":
            $title = "Emotion Regulation Strategies: Cultivating Emotional Well-being";
            $description = "Explore effective emotion regulation strategies for cultivating emotional well-being. Learn practical techniques to manage and navigate a range of emotions, fostering a healthier relationship with your feelings.";
            $keywords = "emotion regulation, emotional well-being, coping strategies, emotional intelligence, managing emotions";
            break;

        case "understanding-purpose":
            $title = "Understanding Your Purpose: Discovering Meaning and Direction in Life";
            $description = "Explore resources and insights to help you understand your purpose in life. Discover practical strategies, self-reflection exercises, and inspiration for finding meaning and direction in your personal and professional journey.";
            $keywords = "purpose, life purpose, meaning, self-discovery, personal development, finding direction";
            break;

        case "group-counseling":
            $title = "Group Counseling Services | I will Till I am Well";
            $description = "Explore our group counseling services to find support and guidance in a collaborative environment. Your Organization Name offers expert-led group therapy sessions for various needs.";
            $keywords = "group counseling, therapy sessions, support groups, mental health, counseling services, group therapy";
            break;

        case "telemedicine":
            $title = "Telemedicine Services: Virtual Healthcare Consultations";
            $description = "Experience convenient and reliable telemedicine services with Your Healthcare Provider. Access virtual medical consultations from the comfort of your home.";
            $keywords = "telemedicine, virtual healthcare, online medical consultations, remote medical services, telehealth";
            break;

        case "message-specialist":
            $title = "Message a Specialist: Connect with Expert Advisors";
            $description = "Utilize our 'Message a Specialist' feature to connect with expert advisors. Get personalized advice and assistance from qualified specialists on Your Platform Name.";
            $keywords = "message a specialist, expert advisors, personalized advice, online consultation, specialist support";
            break;

        case "advocay-program":
            $title = "Expert Care Coordination Services for Personalized Support";
            $description = "Discover personalized care coordination services to streamline your healthcare journey. Our expert care coordinators at Your Healthcare Provider ensure seamless communication and support for your well-being.";
            $keywords = "care coordination, healthcare support, patient advocacy, personalized care, health coordination services";
            break;

        case "pet-telehealth":
            $title = "PET Telehealth Services | I Will Till I M Well";
            $description = "Explore PET telehealth services for remote diagnostics and consultations. Connect with experienced PET specialists from the comfort of your home.";
            $keywords = "PET, Positron Emission Tomography, Telehealth, Remote Diagnostics, Virtual Consultations, Medical Imaging";
            break;

        case "legal-service":
            $title = "Legal Information Services | I Will Till I M Well";
            $description = "Explore comprehensive legal information services to stay informed about laws, regulations, and legal updates. Access expert insights on various legal topics for individuals and businesses.";
            $keywords = "legal information, law updates, legal advice, legal resources, legal research, legal topics";
            break;

        case "prescription-policy":
            $title = "iWILL ‘til i’mWELL Prescription Policy";
            $description = "Learn about our prescription policy for medication requests and refills. We adhere to all applicable laws and regulations, and prescriptions are only issued after a thorough evaluation by our licensed healthcare professionals. Please review our prescription policy for more information.";
            // No specific keywords provided for this case
            break;

        case "professional-welllness-partners":
            $title = "Professional Wellness Partners";
            $description = "Join us at IWillTilImWell if you want to partner with a company that is working to help enable the physical, emotional, mental and spiritual well-being of people in need.";
            // No specific keywords provided for this case
            break;

        case "access-bipoc":
            $title = "At iWILL ‘til i'mWELL - We support equal access for our Bipoc Community";
            $description = "We are committed to equal access for all. Our services and content aim to create an inclusive environment for the BIPOC community. Learn more about our dedication to diversity, equity, and inclusion.";
            // No specific keywords provided for this case
            break;

        case "access-latino":
            $title = "Inclusion and Access –Latino | IWill ‘Til I”MWELL";
            $description = "Dedicated to Equal Access: We proudly support equal access for the Hispanic community. Our services are designed to be inclusive, fostering diversity and ensuring equitable opportunities for all members of the Hispanic community. Learn more about our commitment to diversity and inclusion.";
            // No specific keywords provided for this case
            break;

        case "access-lgbtq":
            $title = "Inclusion and Access – LGBTQ";
            $description = "Championing Equal Access: We proudly support equal access for the LGBTQ community. Our services are tailored to be inclusive, fostering diversity and ensuring equitable opportunities for all members of the LGBTQ community. Explore more about our commitment to diversity and inclusion.";
            // No specific keywords provided for this case
            break;

        case "blogs":
            $title = "IWill Til I MWELL Health Blog - Latest Insights on Wellness and Medicine";
            $description = "Explore our health blog for the latest insights on wellness, medicine, nutrition, and fitness. Stay informed about health trends and expert advice for a healthier lifestyle.";
            $keywords = "health blog, wellness, medicine, nutrition, fitness, healthy lifestyle, health trends";
            break;

        case "brochure":
            $title = "IWill ‘Til I”MWELL | Your Wellness Resource";
            $description = "Explore our 'Til I”MWELL brochure for valuable insights on wellness, health tips, and resources to support your journey to a healthier lifestyle. Download the brochure for comprehensive information.";
            // No specific keywords provided for this case
            break;

        case "topics/healthy-eating":
            $title = "Healthy Eating Topics - Nutrition, Recipes, and Wellness Tips";
            $description = "Discover a wealth of information on healthy eating topics. Explore nutrition guides, delicious recipes, and wellness tips to support your journey to a healthier lifestyle. Stay informed and make mindful choices for your well-being.";
            $keywords = "healthy eating, nutrition, recipes, wellness tips, mindful eating, balanced diet";
            break;

        case "topics/inspirational":
            $title = "Inspirational Stories and Quotes | Empowering Your Journey";
            $description = "Discover a collection of inspirational stories, quotes, and wisdom to uplift your spirit. Find motivation, positivity, and encouragement for every aspect of your life's journey. Let our content inspire and empower you to reach new heights.";
            $keywords = "inspiration, motivational stories, uplifting quotes, personal growth, positivity, empowerment";
            break;

        case "medical-care-consent":
            $title = "Medical Care Consent: Your Guide to Informed Healthcare Decision-Making";
            $description = "Understand the importance of medical care consent. Explore our guide to informed healthcare decision-making, patient rights, and the consent process. Empowering you to make informed choices for your medical care.";
            $keywords = "medical care consent, informed consent, patient rights, healthcare decision-making, medical procedures, healthcare information";
            break;

        case "healthcare-advocacy":
            $title = "Healthcare Advocacy Help Line | Empowering Your Health Journey";
            $description = "Our healthcare advocacy help line is committed to supporting you on your health journey. Connect with our experts for guidance on navigating the healthcare system, understanding your rights, and making informed decisions about your well-being.";
            $keywords = "healthcare advocacy, health helpline, patient rights, healthcare guidance, medical support, healthcare decisions";
            break;

        case "contact-us":
            $title = "Contact Us - I Will Til I'm Well";
            $description = "Get in touch with us at I Will Til I'm Well. Reach out for support, inquiries, or any questions you may have. We're here to assist you on your journey to well-being.";
            // No specific keywords provided for this case
            break;

        case "privacy-policy":
            $title = "Privacy Policy - I Will Til I'm Well";
            $description = "Learn about our privacy practices at I Will Til I'm Well. This Privacy Policy explains how we collect, use, and protect your personal information. We are committed to safeguarding your privacy and maintaining the confidentiality of your data.";
            $keywords = "privacy policy, data protection, personal information, confidentiality, online privacy";
            break;

        case "refund-policy":
            $title = "I Will Til I'm Well Telemedicine Refund Policy";
            $description = "Review our Telemedicine Refund Policy at I Will Til I'm Well. Understand the terms and conditions related to refunds for telemedicine services. We are committed to transparency and ensuring a satisfactory experience for our users.";
            $keywords = "telemedicine refund policy, refund terms, telehealth services, I Will Til I'm Well, user satisfaction";
            break;

        case "register":
            $title = "Join the iWILL 'til i'mWELL community";
            $description = "Become part of the I WILL 'til i'mWELL community and embark on a journey to health and wellness. Connect with like-minded individuals, access valuable resources, and receive support for your well-being goals.";
            $keywords = "I WILL 'til i'mWELL, community, health and wellness, well-being support, connect, like-minded individuals";
            break;

        default:
            // Default case if the URL segment doesn't match any condition
            break;
    }

    return $metaTags = [
        'title' => $title,
        'description' => $description,
        'keywords' => $keywords,
    ];
    
}

?>
