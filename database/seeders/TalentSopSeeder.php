<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TalentSopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('talent_sops')->insert([
            [
                'sop_formula' => 'Make sure to follow the naming format for 3D SketchUp files.',
                'note' => 'Use this format: p1-5_[File Name]_[v1] - p = Page (e.g., p1-5) - File Name = Original client file name - V = Version (revision number).',
            ],
            [
                'sop_formula' => 'Double-check your scenes to make sure they meet the standard, including split scenes.',
                'note' => 'Use this naming format: (17p1f), (17p1f_line), (17p1f_shadow). For specific objects like a chair, use: (17p1f_chair), (17p1f_line_chair). - p = Page (based on panel number) - f = Frame (panel).',
            ],
            [
                'sop_formula' => 'Make sure to export 3 layers for 3D: base texture, line art, and shadow.',
                'note' => 'Stick to this when creating layers: - Base Texture - Line Art - Shadows.',
            ],
            [
                'sop_formula' => 'When setting shadows in a scene, don’t include ceiling objects.',
                'note' => 'While adjusting shadows, make sure to hide ceiling objects like lamps or ceiling pillars. Follow the new shadow settings (see the attached file).',
            ],
            [
                'sop_formula' => 'Make sure the 3D line art isn’t thicker than the character line art.',
                'note' => 'Keep the background line art thinner than the character lines.',
            ],
            [
                'sop_formula' => 'Don’t rename the Photoshop assets.',
                'note' => 'Ensure page numbers have 3 digits (e.g., 001, 002, 003).',
            ],
            [
                'sop_formula' => 'For objects with multiple layers, create sub-layers like Base for the background and name the rest accordingly.',
                'note' => 'If a scene has different layers, group them in folders. For example, Frame 1 could have sub-layers like chairs, tables, and a base for the background.',
            ],
            [
                'sop_formula' => 'Make sure to use the auto action for setting up Photoshop folder structures.',
                'note' => 'When creating a new folder structure, use the auto action to keep things consistent.',
            ],
            [
                'sop_formula' => 'Don’t forget to add character highlights.',
                'note' => 'Use the auto action for efficiency. Highlight characters with white and set opacity to 50%.',
            ],
            [
                'sop_formula' => 'When uploading your project, follow the folder naming conventions on the drive.',
                'note' => 'MAIN DRIVE - Start with a folder named after your episode, like Tasogare_Epi1. Then follow the folder structure for drafts and revisions: First Draft, Revise 1, Revise 2, etc.',
            ],
        ]);
    }
}
