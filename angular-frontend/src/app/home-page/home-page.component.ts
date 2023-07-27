import {Component} from '@angular/core';
import {faCircleNotch, faSpinner} from "@fortawesome/free-solid-svg-icons";
import {Color, ScaleType} from "@swimlane/ngx-charts";

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss']
})
export class HomePageComponent {
  colorScheme: Color = {
    name: 'nyeko',
    selectable: true,
    group: ScaleType.Ordinal,
    domain: ['#00C992', '#00A99F', '#008898', '#00677E', '#2F4858']
  };

  pieChartPositions = [
    { name: "Frontend", value: 98 },
    { name: "Backend", value: 42 },
    { name: "DevOps", value: 21 },
    { name: "Data", value: 2 },
    { name: "Cloud", value: 4 }
  ];

  barOpenPositions = [
    { name: '36. hét', value: 120},
    { name: '37. hét', value: 98},
    { name: '38. hét', value: 94},
    { name: '39. hét', value: 34},
  ];

  treeMapStacks = [
    { name: 'PHP', value: 13 },
    { name: 'Angular', value: 40 },
    { name: 'React', value: 60 },
    { name: '.NET', value: 24 },
    { name: 'Java', value: 15 },
    { name: 'Go', value: 20 },
    { name: 'Python', value: 40 },
  ];

  barFrontend = [
    { name: 'intern', value: 250000 },
    { name: 'junior', value: 400000 },
    { name: 'medior', value: 600000 },
    { name: 'senior', value: 1100000 },
    { name: 'lead', value: 1800000 },
  ];

  barBackend = [
    { name: 'intern', value: 250000 },
    { name: 'junior', value: 400000 },
    { name: 'medior', value: 600000 },
    { name: 'senior', value: 1100000 },
    { name: 'lead', value: 1800000 },
  ];

  barStack = [
    { name: 'PHP', series:
        [
          { name: 'junior', value: 350000 },
          { name: 'medior', value: 550000 },
          { name: 'senior', value: 800000 },
        ]
    },
    { name: 'Java', series:
        [
          { name: 'junior', value: 452000 },
          { name: 'medior', value: 653000 },
          { name: 'senior', value: 998000 },
        ]
    },
    { name: 'Angular', series:
        [
          { name: 'junior', value: 552000 },
          { name: 'medior', value: 893000 },
          { name: 'senior', value: 1118000 },
          { name: 'lead', value: 1088000 },
        ]
    },
  ];
  protected readonly faSpinner = faSpinner;
  protected readonly faCircleNotch = faCircleNotch;
}
