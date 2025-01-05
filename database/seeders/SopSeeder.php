<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SopSeeder extends Seeder
{
    public function run()
    {
        DB::table('sops')->insert([
            [
                'steps' => '3D FILE NAME',
                'standard' => 'follow format name with: p1-5_[File Name]_[v1] - p = Page (eg. p1-5) - File Name = Raw file name from client - V = Version (based on revision)',
                'note' => 'Make sure all the scene follow format name',
            ],
            [
                'steps' => '3D SCENE NAME',
                'standard' => 'Follow format name with: (17p1f), (17p1f_line), (17p1f_shadow). If there\'s any specific object example chair: (17p1f_chair), (17p1f_line_chair). - p = page (based on panel number) - f = frame (panel)',
                'note' => 'Make sure all the scene follow format name',
            ],
            [
                'steps' => '3D SCENE SETTINGS',
                'standard' => 'Please follow the standard when create the - Base Texture - Line Art - Shadows',
                'note' => 'Check file attachment below to follow file standard',
            ],
            [
                'steps' => 'SHADOW SETTINGS',
                'standard' => 'When make a settings for shadows, make sure object in ceiling are hide (eg. lamp shadow, or ceiling pillars). Follow the new shadows settings (see the attachment file)',
                'note' => 'In addition to displaying the ceiling, you can also fix this by setting it so that shadows are not displayed on the ceiling pillars!',
            ],
            [
                'steps' => 'LINE ART BACKGROUND',
                'standard' => 'Make sure line background not bolder than line art characters.',
                'note' => 'Don\'t change anything from RAW file name, except numbering PSD file name.',
            ],
            [
                'steps' => 'PSD FILE NAME',
                'standard' => 'Make sure the end of the page number follows 3 characters (eg. 001, 002, 003)',
                'note' => 'Don\'t change anything from RAW file name, except numbering PSD file name.',
            ],
            [
                'steps' => 'Layer sub Folder',
                'standard' => 'If there are several different layers in 1 scene, create sub layers under the folder (frame for example 1) such as chairs, tables, dan base for base background layers.',
                'note' => 'Give "Base" for folder with base background layers.',
            ],
            [
                'steps' => 'FILE STRUCTURE',
                'standard' => 'When create new folder structure make sure follow auto action',
                'note' => 'Auto Action File Check SOP Document',
            ],
            [
                'steps' => 'Character Highlight',
                'standard' => 'Use auto action to make it efficient',
                'note' => 'Auto Action File Check SOP Document',
            ],
            [
                'steps' => 'Drive Structure',
                'standard' => 'MAIN DRIVE - When upload your works in the first name, create folder based on your episode example: Tasogare_Epi1 - (After that follow drive structure based on version of your works: First Draft, Revise1, Revise 2)',
                'note' => 'For each specific folder you can upload all your works with following structure: PSD PNG 3D.',
            ],
        ]);
    }
}

