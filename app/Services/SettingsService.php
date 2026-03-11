<?php

namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        return Setting::getValue($key, $default);
    }

    /**
     * Get all settings from a group
     */
    public static function getGroup(string $group)
    {
        return Setting::getGroup($group);
    }

    /**
     * Get general site settings
     */
    public static function getSiteInfo()
    {
        return [
            'name' => self::get('site_name', 'AFAQ Real Estate'),
            'description' => self::get('site_description', 'Your trusted real estate partner'),
            'logo' => self::get('site_logo'),
            'phone' => self::get('contact_phone', '+966 50 123 4567'),
            'email' => self::get('contact_email', 'info@afaq.com'),
            'address' => self::get('contact_address', 'Riyadh, Saudi Arabia'),
        ];
    }

    /**
     * Get business statistics
     */
    public static function getBusinessStats()
    {
        return [
            'total_properties' => self::get('total_properties', 150),
            'years_experience' => self::get('years_experience', 10),
            'business_hours' => self::get('business_hours', 'Saturday - Thursday: 9:00 AM - 6:00 PM'),
        ];
    }

    /**
     * Get social media links
     */
    public static function getSocialLinks()
    {
        return [
            'facebook' => self::get('facebook_url'),
            'twitter' => self::get('twitter_url'),
            'instagram' => self::get('instagram_url'),
        ];
    }

    /**
     * Get SEO settings
     */
    public static function getSeoSettings()
    {
        return [
            'keywords' => self::get('meta_keywords', 'real estate, property, saudi arabia'),
            'description' => self::get('meta_description', 'AFAQ Real Estate - Your trusted partner'),
        ];
    }
}
