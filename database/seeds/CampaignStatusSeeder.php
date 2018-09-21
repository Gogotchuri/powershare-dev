<?php

use Illuminate\Database\Seeder;
use \App\Models\Reference\CampaignStatus;

class CampaignStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            CampaignStatus::APPROVED,
            CampaignStatus::PROPOSAL,
            CampaignStatus::DRAFT,
        ];

        foreach ($statuses as $statusId) {
            $projectStatus = new CampaignStatus();
            $projectStatus->id = $statusId;
            $projectStatus->name = CampaignStatus::nameFromId($statusId);
            $projectStatus->save();
        }
    }
}
