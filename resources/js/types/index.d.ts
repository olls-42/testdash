import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
    adminOnly?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    is_admin: number;
    domains: Array<Domain>
    plan: Plan
}

export interface Domain {
    id: number;
    user_id: number
    domain: string,
    created_at: string;
    updated_at: string;
}

export interface Plan {
    id: number;
    plan_name: string;
    features: object;
    price: number;
}

export type BreadcrumbItemType = BreadcrumbItem;
