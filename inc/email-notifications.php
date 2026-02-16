<?php
/**
 * Email Notifications
 * Send email notifications for form submissions
 * 
 * @package RISE_AI_Summit
 */

if (!defined('ABSPATH')) exit;

/**
 * ==============================================
 * 1. ABSTRACT SUBMISSION NOTIFICATIONS
 * ==============================================
 */
function rise_send_abstract_notification($post_id, $data) {
    
    // Get current language (if Polylang is active)
    $lang = function_exists('pll_current_language') ? pll_current_language() : 'en';
    
    // ===== ADMIN NOTIFICATION =====
    $admin_email = 'research@rise-summit.cl';
    
    if ($lang === 'es') {
        $admin_subject = 'Nuevo envío de resumen - RISE AI Summit';
        $admin_message = "Nuevo resumen recibido:\n\n";
        $admin_message .= "Autor: {$data['first_name']} {$data['last_name']}\n";
        $admin_message .= "Email: {$data['email']}\n";
        $admin_message .= "Institución: {$data['institution']}\n";
        $admin_message .= "País: {$data['country']}\n";
        $admin_message .= "Track: {$data['track']}\n";
        $admin_message .= "Título: {$data['title']}\n\n";
        $admin_message .= "Ver en admin: " . admin_url('post.php?post=' . $post_id . '&action=edit');
    } else {
        $admin_subject = 'New Abstract Submission - RISE AI Summit';
        $admin_message = "New abstract received:\n\n";
        $admin_message .= "Author: {$data['first_name']} {$data['last_name']}\n";
        $admin_message .= "Email: {$data['email']}\n";
        $admin_message .= "Institution: {$data['institution']}\n";
        $admin_message .= "Country: {$data['country']}\n";
        $admin_message .= "Track: {$data['track']}\n";
        $admin_message .= "Title: {$data['title']}\n\n";
        $admin_message .= "View in admin: " . admin_url('post.php?post=' . $post_id . '&action=edit');
    }
    
    wp_mail($admin_email, $admin_subject, $admin_message);
    
    // ===== USER CONFIRMATION =====
    if ($lang === 'es') {
        $user_subject = 'Confirmación de envío - RISE AI Summit';
        $user_message = "Estimado/a {$data['first_name']},\n\n";
        $user_message .= "Hemos recibido tu resumen exitosamente para la RISE AI South America Summit 2026.\n\n";
        $user_message .= "DETALLES DEL ENVÍO:\n";
        $user_message .= "------------------------\n";
        $user_message .= "Título: {$data['title']}\n";
        $user_message .= "Track: {$data['track']}\n";
        $user_message .= "Fecha de envío: " . current_time('F j, Y') . "\n\n";
        $user_message .= "PRÓXIMOS PASOS:\n";
        $user_message .= "------------------------\n";
        $user_message .= "• Tu resumen será revisado por nuestro Comité de Programa\n";
        $user_message .= "• Te contactaremos antes del 15 de agosto de 2026 con el resultado\n";
        $user_message .= "• Los autores aceptados recibirán instrucciones para la presentación de posters\n\n";
        $user_message .= "Si tienes alguna pregunta, contáctanos en research@rise-summit.cl\n\n";
        $user_message .= "Saludos cordiales,\n";
        $user_message .= "Equipo RISE AI Summit\n";
        $user_message .= "Universidad de los Andes & University of Notre Dame";
    } else {
        $user_subject = 'Submission Confirmation - RISE AI Summit';
        $user_message = "Dear {$data['first_name']},\n\n";
        $user_message .= "We have successfully received your abstract for the RISE AI South America Summit 2026.\n\n";
        $user_message .= "SUBMISSION DETAILS:\n";
        $user_message .= "------------------------\n";
        $user_message .= "Title: {$data['title']}\n";
        $user_message .= "Track: {$data['track']}\n";
        $user_message .= "Submission date: " . current_time('F j, Y') . "\n\n";
        $user_message .= "NEXT STEPS:\n";
        $user_message .= "------------------------\n";
        $user_message .= "• Your abstract will be reviewed by our Program Committee\n";
        $user_message .= "• We will contact you before August 15, 2026 with the decision\n";
        $user_message .= "• Accepted authors will receive poster presentation instructions\n\n";
        $user_message .= "If you have any questions, please contact us at research@rise-summit.cl\n\n";
        $user_message .= "Best regards,\n";
        $user_message .= "RISE AI Summit Team\n";
        $user_message .= "Universidad de los Andes & University of Notre Dame";
    }
    
    wp_mail($data['email'], $user_subject, $user_message);
}

/**
 * ==============================================
 * 2. REGISTRATION INTEREST NOTIFICATIONS
 * ==============================================
 */
function rise_send_registration_notification($post_id, $data) {
    
    $lang = function_exists('pll_current_language') ? pll_current_language() : 'en';
    
    // ===== ADMIN NOTIFICATION =====
    $admin_email = 'info@rise-summit.cl';
    
    if ($lang === 'es') {
        $admin_subject = 'Nuevo interés de registro - RISE AI Summit';
        $admin_message = "Nuevo registro de interés:\n\n";
        $admin_message .= "Nombre: {$data['full_name']}\n";
        $admin_message .= "Email: {$data['email']}\n";
        $admin_message .= "Institución: {$data['institution']}\n";
        $admin_message .= "País: {$data['country']}\n";
        $admin_message .= "Tipo: {$data['attendee_type']}\n\n";
        $admin_message .= "Ver en admin: " . admin_url('post.php?post=' . $post_id . '&action=edit');
    } else {
        $admin_subject = 'New Registration Interest - RISE AI Summit';
        $admin_message = "New registration interest:\n\n";
        $admin_message .= "Name: {$data['full_name']}\n";
        $admin_message .= "Email: {$data['email']}\n";
        $admin_message .= "Institution: {$data['institution']}\n";
        $admin_message .= "Country: {$data['country']}\n";
        $admin_message .= "Type: {$data['attendee_type']}\n\n";
        $admin_message .= "View in admin: " . admin_url('post.php?post=' . $post_id . '&action=edit');
    }
    
    wp_mail($admin_email, $admin_subject, $admin_message);
    
    // ===== USER CONFIRMATION =====
    if ($lang === 'es') {
        $user_subject = 'Gracias por tu interés - RISE AI Summit';
        $user_message = "Hola {$data['full_name']},\n\n";
        $user_message .= "¡Gracias por tu interés en la RISE AI South America Summit 2026!\n\n";
        $user_message .= "Hemos registrado tu información y te mantendremos actualizado/a sobre:\n";
        $user_message .= "• Apertura de registro oficial (marzo 2026)\n";
        $user_message .= "• Tarifas early bird para estudiantes y profesionales\n";
        $user_message .= "• Anuncios de speakers y programa\n";
        $user_message .= "• Información de alojamiento y viaje\n\n";
        $user_message .= "FECHAS CLAVE:\n";
        $user_message .= "------------------------\n";
        $user_message .= "• 15-16 de octubre, 2026\n";
        $user_message .= "• Universidad de los Andes, Santiago, Chile\n\n";
        $user_message .= "Visita nuestro sitio web: " . home_url() . "\n\n";
        $user_message .= "Saludos,\n";
        $user_message .= "Equipo RISE AI Summit";
    } else {
        $user_subject = 'Thank You for Your Interest - RISE AI Summit';
        $user_message = "Hi {$data['full_name']},\n\n";
        $user_message .= "Thank you for your interest in the RISE AI South America Summit 2026!\n\n";
        $user_message .= "We have registered your information and will keep you updated on:\n";
        $user_message .= "• Official registration opening (March 2026)\n";
        $user_message .= "• Early bird rates for students and professionals\n";
        $user_message .= "• Speaker and program announcements\n";
        $user_message .= "• Accommodation and travel information\n\n";
        $user_message .= "KEY DATES:\n";
        $user_message .= "------------------------\n";
        $user_message .= "• October 15-16, 2026\n";
        $user_message .= "• Universidad de los Andes, Santiago, Chile\n\n";
        $user_message .= "Visit our website: " . home_url() . "\n\n";
        $user_message .= "Best regards,\n";
        $user_message .= "RISE AI Summit Team";
    }
    
    wp_mail($data['email'], $user_subject, $user_message);
}

/**
 * ==============================================
 * 3. SPONSOR INQUIRY NOTIFICATIONS
 * ==============================================
 */
function rise_send_sponsor_notification($post_id, $data) {
    
    $lang = function_exists('pll_current_language') ? pll_current_language() : 'en';
    
    // ===== ADMIN NOTIFICATION =====
    $admin_email = 'sponsors@rise-summit.cl';
    
    if ($lang === 'es') {
        $admin_subject = 'Nueva consulta de patrocinio - RISE AI Summit';
        $admin_message = "Nueva consulta de patrocinio:\n\n";
        $admin_message .= "EMPRESA:\n";
        $admin_message .= "------------------------\n";
        $admin_message .= "Nombre: {$data['company']}\n";
        $admin_message .= "Industria: {$data['industry']}\n";
        $admin_message .= "Sitio web: {$data['website']}\n\n";
        $admin_message .= "CONTACTO:\n";
        $admin_message .= "------------------------\n";
        $admin_message .= "Nombre: {$data['contact_name']}\n";
        $admin_message .= "Cargo: {$data['contact_title']}\n";
        $admin_message .= "Email: {$data['contact_email']}\n";
        $admin_message .= "Teléfono: {$data['contact_phone']}\n\n";
        $admin_message .= "MENSAJE:\n";
        $admin_message .= "------------------------\n";
        $admin_message .= $data['message'] . "\n\n";
        $admin_message .= "Ver en admin: " . admin_url('post.php?post=' . $post_id . '&action=edit');
    } else {
        $admin_subject = 'New Sponsorship Inquiry - RISE AI Summit';
        $admin_message = "New sponsorship inquiry:\n\n";
        $admin_message .= "COMPANY:\n";
        $admin_message .= "------------------------\n";
        $admin_message .= "Name: {$data['company']}\n";
        $admin_message .= "Industry: {$data['industry']}\n";
        $admin_message .= "Website: {$data['website']}\n\n";
        $admin_message .= "CONTACT:\n";
        $admin_message .= "------------------------\n";
        $admin_message .= "Name: {$data['contact_name']}\n";
        $admin_message .= "Title: {$data['contact_title']}\n";
        $admin_message .= "Email: {$data['contact_email']}\n";
        $admin_message .= "Phone: {$data['contact_phone']}\n\n";
        $admin_message .= "MESSAGE:\n";
        $admin_message .= "------------------------\n";
        $admin_message .= $data['message'] . "\n\n";
        $admin_message .= "View in admin: " . admin_url('post.php?post=' . $post_id . '&action=edit');
    }
    
    wp_mail($admin_email, $admin_subject, $admin_message);
    
    // ===== USER CONFIRMATION =====
    if ($lang === 'es') {
        $user_subject = 'Gracias por tu consulta - RISE AI Summit';
        $user_message = "Estimado/a {$data['contact_name']},\n\n";
        $user_message .= "Gracias por tu interés en patrocinar la RISE AI South America Summit 2026.\n\n";
        $user_message .= "Hemos recibido tu consulta y nuestro equipo de patrocinios se pondrá en contacto contigo dentro de las próximas 48 horas para discutir las oportunidades disponibles.\n\n";
        $user_message .= "SOBRE EL EVENTO:\n";
        $user_message .= "------------------------\n";
        $user_message .= "• Fechas: 15-16 de octubre, 2026\n";
        $user_message .= "• Ubicación: Universidad de los Andes, Santiago\n";
        $user_message .= "• Audiencia: Académicos, líderes empresariales, y responsables de políticas\n";
        $user_message .= "• Enfoque: IA Responsable, Inclusiva, Segura y Ética\n\n";
        $user_message .= "Mientras tanto, puedes descargar nuestro prospecto de patrocinio en:\n";
        $user_message .= home_url('/sponsorship/') . "\n\n";
        $user_message .= "Saludos cordiales,\n";
        $user_message .= "Equipo de Patrocinios\n";
        $user_message .= "RISE AI Summit\n";
        $user_message .= "sponsors@rise-summit.cl";
    } else {
        $user_subject = 'Thank You for Your Inquiry - RISE AI Summit';
        $user_message = "Dear {$data['contact_name']},\n\n";
        $user_message .= "Thank you for your interest in sponsoring the RISE AI South America Summit 2026.\n\n";
        $user_message .= "We have received your inquiry and our sponsorship team will contact you within the next 48 hours to discuss available opportunities.\n\n";
        $user_message .= "ABOUT THE EVENT:\n";
        $user_message .= "------------------------\n";
        $user_message .= "• Dates: October 15-16, 2026\n";
        $user_message .= "• Location: Universidad de los Andes, Santiago\n";
        $user_message .= "• Audience: Academics, business leaders, and policymakers\n";
        $user_message .= "• Focus: Responsible, Inclusive, Safe, and Ethical AI\n\n";
        $user_message .= "In the meantime, you can download our sponsorship prospectus at:\n";
        $user_message .= home_url('/sponsorship/') . "\n\n";
        $user_message .= "Best regards,\n";
        $user_message .= "Sponsorship Team\n";
        $user_message .= "RISE AI Summit\n";
        $user_message .= "sponsors@rise-summit.cl";
    }
    
    wp_mail($data['contact_email'], $user_subject, $user_message);
}