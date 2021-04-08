import React from "react";
import { Feed } from "../app/Modules/Social/Resources/Assets/js/components/feed/Feed";
// Will need changes to feed before this is functional due to reliance on laravel echo
export default {
    title: "Social Feed",
    component: Feed
};

export const Default = () => <Feed />
Default.story = {
    name: "Default Set up"
}
