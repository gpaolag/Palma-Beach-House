<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita05047591930ebff7494e267ee440824
{
    public static $files = array (
        'afb908869c16f5a3a20460ae61fa6657' => __DIR__ . '/../..' . '/includes/functions.php',
        'ea04a3978772dbb836fd9b533d28b30d' => __DIR__ . '/../..' . '/includes/settings.php',
        '535ddf772ab9346af6624e3e48e4284c' => __DIR__ . '/../..' . '/includes/meta-boxes.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'ControlPatterns\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ControlPatterns\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'ControlPatterns\\About' => __DIR__ . '/../..' . '/classes/About.php',
        'ControlPatterns\\Autoloader' => __DIR__ . '/../..' . '/classes/Autoloader.php',
        'ControlPatterns\\Blocks\\ActiveBlock' => __DIR__ . '/../..' . '/classes/Blocks/ActiveBlock.php',
        'ControlPatterns\\Blocks\\Block' => __DIR__ . '/../..' . '/classes/Blocks/Block.php',
        'ControlPatterns\\Blocks\\BlockPostMeta' => __DIR__ . '/../..' . '/classes/Blocks/BlockPostMeta.php',
        'ControlPatterns\\Blocks\\Loader' => __DIR__ . '/../..' . '/classes/Blocks/Loader.php',
        'ControlPatterns\\Blocks\\Storages\\Attributes' => __DIR__ . '/../..' . '/classes/Blocks/Storages/Attributes.php',
        'ControlPatterns\\Blocks\\Storages\\PostMeta' => __DIR__ . '/../..' . '/classes/Blocks/Storages/PostMeta.php',
        'ControlPatterns\\Cloner' => __DIR__ . '/../..' . '/classes/Cloner.php',
        'ControlPatterns\\Columns\\Base' => __DIR__ . '/../..' . '/classes/Columns/Base.php',
        'ControlPatterns\\Columns\\Loader' => __DIR__ . '/../..' . '/classes/Columns/Loader.php',
        'ControlPatterns\\Columns\\Model' => __DIR__ . '/../..' . '/classes/Columns/Model.php',
        'ControlPatterns\\Columns\\Post' => __DIR__ . '/../..' . '/classes/Columns/Post.php',
        'ControlPatterns\\Columns\\Processor' => __DIR__ . '/../..' . '/classes/Columns/Processor.php',
        'ControlPatterns\\Columns\\Row' => __DIR__ . '/../..' . '/classes/Columns/Row.php',
        'ControlPatterns\\Columns\\Taxonomy' => __DIR__ . '/../..' . '/classes/Columns/Taxonomy.php',
        'ControlPatterns\\Columns\\User' => __DIR__ . '/../..' . '/classes/Columns/User.php',
        'ControlPatterns\\Conditional' => __DIR__ . '/../..' . '/classes/Conditional.php',
        'ControlPatterns\\Core' => __DIR__ . '/../..' . '/classes/Core.php',
        'ControlPatterns\\Dashboard' => __DIR__ . '/../..' . '/classes/Dashboard.php',
        'ControlPatterns\\Field' => __DIR__ . '/../..' . '/classes/Field.php',
        'ControlPatterns\\Field_Registry' => __DIR__ . '/../..' . '/classes/Field_Registry.php',
        'ControlPatterns\\Fields\\Autocomplete' => __DIR__ . '/../..' . '/classes/Fields/Autocomplete.php',
        'ControlPatterns\\Fields\\Background' => __DIR__ . '/../..' . '/classes/Fields/Background.php',
        'ControlPatterns\\Fields\\Backup' => __DIR__ . '/../..' . '/classes/Fields/Backup.php',
        'ControlPatterns\\Fields\\Button' => __DIR__ . '/../..' . '/classes/Fields/Button.php',
        'ControlPatterns\\Fields\\Button_Group' => __DIR__ . '/../..' . '/classes/Fields/Button_Group.php',
        'ControlPatterns\\Fields\\Checkbox' => __DIR__ . '/../..' . '/classes/Fields/Checkbox.php',
        'ControlPatterns\\Fields\\Checkbox_List' => __DIR__ . '/../..' . '/classes/Fields/Checkbox_List.php',
        'ControlPatterns\\Fields\\Choice' => __DIR__ . '/../..' . '/classes/Fields/Choice.php',
        'ControlPatterns\\Fields\\Color' => __DIR__ . '/../..' . '/classes/Fields/Color.php',
        'ControlPatterns\\Fields\\Custom_Html' => __DIR__ . '/../..' . '/classes/Fields/Custom_Html.php',
        'ControlPatterns\\Fields\\Date' => __DIR__ . '/../..' . '/classes/Fields/Date.php',
        'ControlPatterns\\Fields\\Datetime' => __DIR__ . '/../..' . '/classes/Fields/Datetime.php',
        'ControlPatterns\\Fields\\Divider' => __DIR__ . '/../..' . '/classes/Fields/Divider.php',
        'ControlPatterns\\Fields\\Editor' => __DIR__ . '/../..' . '/classes/Fields/Editor.php',
        'ControlPatterns\\Fields\\Fieldset_Text' => __DIR__ . '/../..' . '/classes/Fields/Fieldset_Text.php',
        'ControlPatterns\\Fields\\File' => __DIR__ . '/../..' . '/classes/Fields/File.php',
        'ControlPatterns\\Fields\\File_Input' => __DIR__ . '/../..' . '/classes/Fields/File_Input.php',
        'ControlPatterns\\Fields\\File_Upload' => __DIR__ . '/../..' . '/classes/Fields/File_Upload.php',
        'ControlPatterns\\Fields\\Google_Fonts' => __DIR__ . '/../..' . '/classes/Fields/Google_Fonts.php',
        'ControlPatterns\\Fields\\Group' => __DIR__ . '/../..' . '/classes/Fields/Group.php',
        'ControlPatterns\\Fields\\Heading' => __DIR__ . '/../..' . '/classes/Fields/Heading.php',
        'ControlPatterns\\Fields\\Icon_Picker' => __DIR__ . '/../..' . '/classes/Fields/Icon_Picker.php',
        'ControlPatterns\\Fields\\Icon_Picker_Input' => __DIR__ . '/../..' . '/classes/Fields/Icon_Picker_Input.php',
        'ControlPatterns\\Fields\\Image' => __DIR__ . '/../..' . '/classes/Fields/Image.php',
        'ControlPatterns\\Fields\\Image_Advanced' => __DIR__ . '/../..' . '/classes/Fields/Image_Advanced.php',
        'ControlPatterns\\Fields\\Image_Input' => __DIR__ . '/../..' . '/classes/Fields/Image_Input.php',
        'ControlPatterns\\Fields\\Image_Select' => __DIR__ . '/../..' . '/classes/Fields/Image_Select.php',
        'ControlPatterns\\Fields\\Image_Upload' => __DIR__ . '/../..' . '/classes/Fields/Image_Upload.php',
        'ControlPatterns\\Fields\\Import' => __DIR__ . '/../..' . '/classes/Fields/Import.php',
        'ControlPatterns\\Fields\\Input' => __DIR__ . '/../..' . '/classes/Fields/Input.php',
        'ControlPatterns\\Fields\\Input_List' => __DIR__ . '/../..' . '/classes/Fields/Input_List.php',
        'ControlPatterns\\Fields\\Key_Value' => __DIR__ . '/../..' . '/classes/Fields/Key_Value.php',
        'ControlPatterns\\Fields\\Link' => __DIR__ . '/../..' . '/classes/Fields/Link.php',
        'ControlPatterns\\Fields\\Map' => __DIR__ . '/../..' . '/classes/Fields/Map.php',
        'ControlPatterns\\Fields\\Measurement' => __DIR__ . '/../..' . '/classes/Fields/Measurement.php',
        'ControlPatterns\\Fields\\Media' => __DIR__ . '/../..' . '/classes/Fields/Media.php',
        'ControlPatterns\\Fields\\Multiple_Values' => __DIR__ . '/../..' . '/classes/Fields/Multiple_Values.php',
        'ControlPatterns\\Fields\\Number' => __DIR__ . '/../..' . '/classes/Fields/Number.php',
        'ControlPatterns\\Fields\\OEmbed' => __DIR__ . '/../..' . '/classes/Fields/OEmbed.php',
        'ControlPatterns\\Fields\\OSM' => __DIR__ . '/../..' . '/classes/Fields/OSM.php',
        'ControlPatterns\\Fields\\Object_Choice' => __DIR__ . '/../..' . '/classes/Fields/Object_Choice.php',
        'ControlPatterns\\Fields\\On_Off' => __DIR__ . '/../..' . '/classes/Fields/On_Off.php',
        'ControlPatterns\\Fields\\Password' => __DIR__ . '/../..' . '/classes/Fields/Password.php',
        'ControlPatterns\\Fields\\Post' => __DIR__ . '/../..' . '/classes/Fields/Post.php',
        'ControlPatterns\\Fields\\Radio' => __DIR__ . '/../..' . '/classes/Fields/Radio.php',
        'ControlPatterns\\Fields\\Range' => __DIR__ . '/../..' . '/classes/Fields/Range.php',
        'ControlPatterns\\Fields\\Select' => __DIR__ . '/../..' . '/classes/Fields/Select.php',
        'ControlPatterns\\Fields\\Select_Advanced' => __DIR__ . '/../..' . '/classes/Fields/Select_Advanced.php',
        'ControlPatterns\\Fields\\Select_Tree' => __DIR__ . '/../..' . '/classes/Fields/Select_Tree.php',
        'ControlPatterns\\Fields\\Sidebar' => __DIR__ . '/../..' . '/classes/Fields/Sidebar.php',
        'ControlPatterns\\Fields\\Single_Image' => __DIR__ . '/../..' . '/classes/Fields/Single_Image.php',
        'ControlPatterns\\Fields\\Slider' => __DIR__ . '/../..' . '/classes/Fields/Slider.php',
        'ControlPatterns\\Fields\\Spacing' => __DIR__ . '/../..' . '/classes/Fields/Spacing.php',
        'ControlPatterns\\Fields\\Switcher' => __DIR__ . '/../..' . '/classes/Fields/Switcher.php',
        'ControlPatterns\\Fields\\Taxonomy' => __DIR__ . '/../..' . '/classes/Fields/Taxonomy.php',
        'ControlPatterns\\Fields\\Taxonomy_Advanced' => __DIR__ . '/../..' . '/classes/Fields/Taxonomy_Advanced.php',
        'ControlPatterns\\Fields\\Text_List' => __DIR__ . '/../..' . '/classes/Fields/Text_List.php',
        'ControlPatterns\\Fields\\Textarea' => __DIR__ . '/../..' . '/classes/Fields/Textarea.php',
        'ControlPatterns\\Fields\\Time' => __DIR__ . '/../..' . '/classes/Fields/Time.php',
        'ControlPatterns\\Fields\\Typography' => __DIR__ . '/../..' . '/classes/Fields/Typography.php',
        'ControlPatterns\\Fields\\User' => __DIR__ . '/../..' . '/classes/Fields/User.php',
        'ControlPatterns\\Fields\\Video' => __DIR__ . '/../..' . '/classes/Fields/Video.php',
        'ControlPatterns\\Fields\\Wysiwyg' => __DIR__ . '/../..' . '/classes/Fields/Wysiwyg.php',
        'ControlPatterns\\Helpers\\Array_Type' => __DIR__ . '/../..' . '/classes/Helpers/Array_Type.php',
        'ControlPatterns\\Helpers\\Field_Type' => __DIR__ . '/../..' . '/classes/Helpers/Field_Type.php',
        'ControlPatterns\\Helpers\\String_Type' => __DIR__ . '/../..' . '/classes/Helpers/String_Type.php',
        'ControlPatterns\\Helpers\\Value_Type' => __DIR__ . '/../..' . '/classes/Helpers/Value_Type.php',
        'ControlPatterns\\Interfaces\\Storage' => __DIR__ . '/../..' . '/classes/Interfaces/Storage.php',
        'ControlPatterns\\Loader' => __DIR__ . '/../..' . '/classes/Loader.php',
        'ControlPatterns\\Media_Modal' => __DIR__ . '/../..' . '/classes/Media_Modal.php',
        'ControlPatterns\\Meta_Box' => __DIR__ . '/../..' . '/classes/Meta_Box.php',
        'ControlPatterns\\Meta_Box_Registry' => __DIR__ . '/../..' . '/classes/Meta_Box_Registry.php',
        'ControlPatterns\\Meta_Group' => __DIR__ . '/../..' . '/classes/Meta_Group.php',
        'ControlPatterns\\Patterns' => __DIR__ . '/../..' . '/classes/Patterns.php',
        'ControlPatterns\\Patterns\\AjaxAction' => __DIR__ . '/../..' . '/classes/Patterns/AjaxAction.php',
        'ControlPatterns\\Patterns\\Attributes' => __DIR__ . '/../..' . '/classes/Patterns/Attributes.php',
        'ControlPatterns\\Patterns\\Core' => __DIR__ . '/../..' . '/classes/Patterns/Core.php',
        'ControlPatterns\\Patterns\\Directory' => __DIR__ . '/../..' . '/classes/Patterns/Directory.php',
        'ControlPatterns\\Patterns\\Helper' => __DIR__ . '/../..' . '/classes/Patterns/Helper.php',
        'ControlPatterns\\Patterns\\PostType' => __DIR__ . '/../..' . '/classes/Patterns/PostType.php',
        'ControlPatterns\\Patterns\\Shortcode' => __DIR__ . '/../..' . '/classes/Patterns/Shortcode.php',
        'ControlPatterns\\Patterns\\Templates' => __DIR__ . '/../..' . '/classes/Patterns/Templates.php',
        'ControlPatterns\\Patterns\\Tools' => __DIR__ . '/../..' . '/classes/Patterns/Tools.php',
        'ControlPatterns\\Patterns\\Widget' => __DIR__ . '/../..' . '/classes/Patterns/Widget.php',
        'ControlPatterns\\Request' => __DIR__ . '/../..' . '/classes/Request.php',
        'ControlPatterns\\Responsive' => __DIR__ . '/../..' . '/classes/Responsive.php',
        'ControlPatterns\\Sanitizer' => __DIR__ . '/../..' . '/classes/Sanitizer.php',
        'ControlPatterns\\Settings\\Customizer\\Control' => __DIR__ . '/../..' . '/classes/Settings/Customizer/Control.php',
        'ControlPatterns\\Settings\\Customizer\\Manager' => __DIR__ . '/../..' . '/classes/Settings/Customizer/Manager.php',
        'ControlPatterns\\Settings\\Customizer\\NormalSection' => __DIR__ . '/../..' . '/classes/Settings/Customizer/NormalSection.php',
        'ControlPatterns\\Settings\\Customizer\\Panel' => __DIR__ . '/../..' . '/classes/Settings/Customizer/Panel.php',
        'ControlPatterns\\Settings\\Customizer\\Setting' => __DIR__ . '/../..' . '/classes/Settings/Customizer/Setting.php',
        'ControlPatterns\\Settings\\Customizer\\SettingsSection' => __DIR__ . '/../..' . '/classes/Settings/Customizer/SettingsSection.php',
        'ControlPatterns\\Settings\\Factory' => __DIR__ . '/../..' . '/classes/Settings/Factory.php',
        'ControlPatterns\\Settings\\Loader' => __DIR__ . '/../..' . '/classes/Settings/Loader.php',
        'ControlPatterns\\Settings\\MetaBox' => __DIR__ . '/../..' . '/classes/Settings/MetaBox.php',
        'ControlPatterns\\Settings\\Network\\MetaBox' => __DIR__ . '/../..' . '/classes/Settings/Network/MetaBox.php',
        'ControlPatterns\\Settings\\Network\\SettingsPage' => __DIR__ . '/../..' . '/classes/Settings/Network/SettingsPage.php',
        'ControlPatterns\\Settings\\Network\\Storage' => __DIR__ . '/../..' . '/classes/Settings/Network/Storage.php',
        'ControlPatterns\\Settings\\SettingsPage' => __DIR__ . '/../..' . '/classes/Settings/SettingsPage.php',
        'ControlPatterns\\Settings\\Storage' => __DIR__ . '/../..' . '/classes/Settings/Storage.php',
        'ControlPatterns\\Settings_Pages' => __DIR__ . '/../..' . '/classes/Settings_Pages.php',
        'ControlPatterns\\Shortcode' => __DIR__ . '/../..' . '/classes/Shortcode.php',
        'ControlPatterns\\Storage_Registry' => __DIR__ . '/../..' . '/classes/Storage_Registry.php',
        'ControlPatterns\\Storages\\Base' => __DIR__ . '/../..' . '/classes/Storages/Base.php',
        'ControlPatterns\\Storages\\Post' => __DIR__ . '/../..' . '/classes/Storages/Post.php',
        'ControlPatterns\\Tabs' => __DIR__ . '/../..' . '/classes/Tabs.php',
        'ControlPatterns\\Term\\Loader' => __DIR__ . '/../..' . '/classes/Term/Loader.php',
        'ControlPatterns\\Term\\MetaBox' => __DIR__ . '/../..' . '/classes/Term/MetaBox.php',
        'ControlPatterns\\Term\\Storage' => __DIR__ . '/../..' . '/classes/Term/Storage.php',
        'ControlPatterns\\Update\\Checker' => __DIR__ . '/../..' . '/classes/Update/Checker.php',
        'ControlPatterns\\Update\\Notification' => __DIR__ . '/../..' . '/classes/Update/Notification.php',
        'ControlPatterns\\Update\\Option' => __DIR__ . '/../..' . '/classes/Update/Option.php',
        'ControlPatterns\\Update\\Settings' => __DIR__ . '/../..' . '/classes/Update/Settings.php',
        'ControlPatterns\\User\\DuplicatedFields' => __DIR__ . '/../..' . '/classes/User/DuplicatedFields.php',
        'ControlPatterns\\User\\Meta' => __DIR__ . '/../..' . '/classes/User/Meta.php',
        'ControlPatterns\\User\\MetaBox' => __DIR__ . '/../..' . '/classes/User/MetaBox.php',
        'ControlPatterns\\User\\Storage' => __DIR__ . '/../..' . '/classes/User/Storage.php',
        'ControlPatterns\\Validation' => __DIR__ . '/../..' . '/classes/Validation.php',
        'ControlPatterns\\WPML' => __DIR__ . '/../..' . '/classes/WPML.php',
        'ControlPatterns\\Walkers\\Base' => __DIR__ . '/../..' . '/classes/Walkers/Base.php',
        'ControlPatterns\\Walkers\\Input_List' => __DIR__ . '/../..' . '/classes/Walkers/Input_List.php',
        'ControlPatterns\\Walkers\\Select' => __DIR__ . '/../..' . '/classes/Walkers/Select.php',
        'ControlPatterns\\Walkers\\Select_Tree' => __DIR__ . '/../..' . '/classes/Walkers/Select_Tree.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita05047591930ebff7494e267ee440824::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita05047591930ebff7494e267ee440824::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita05047591930ebff7494e267ee440824::$classMap;

        }, null, ClassLoader::class);
    }
}
